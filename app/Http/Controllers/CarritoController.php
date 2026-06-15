<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\ItemCarrito;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/**
 * Controlador de gestión del carrito de compras y del proceso de checkout.
 */
class CarritoController extends Controller
{
    /**
     * Muestra la vista del carrito de compras.
     * Valida en tiempo real que los productos mantengan stock suficiente y que no cambiasen de precio.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $usuario = Auth::user();
        $carrito = Carrito::firstOrCreate(['usuario_id' => $usuario->id]);
        $items = $carrito->items()->with('producto')->get();

        $precioActualizadoMensajes = [];
        $sinStockMensajes = [];
        $carritoModificado = false;

        // Comprobación de consistencia de stock y precio para cada ítem en el carrito
        foreach ($items as $item) {
            $producto = $item->producto;
            if ($producto) {
                if (is_null($item->precio_unitario)) {
                    $item->precio_unitario = $producto->precio_actual;
                    $item->save();
                }

                if ($item->precio_unitario != $producto->precio_actual) {
                    $precioActualizadoMensajes[] = "El precio de {$producto->nombre} se ha actualizado de $" . number_format($item->precio_unitario, 2) . " a $" . number_format($producto->precio_actual, 2) . ".";
                    $item->precio_unitario = $producto->precio_actual;
                    $item->save();
                    $carritoModificado = true;
                }

                if ($item->cantidad > $producto->stock) {
                    if ($producto->stock <= 0) {
                        $sinStockMensajes[] = "El producto {$producto->nombre} ya no tiene stock disponible y ha sido removido de tu carrito.";
                        $item->delete();
                    } else {
                        $sinStockMensajes[] = "El stock de {$producto->nombre} ha cambiado. La cantidad en tu carrito fue ajustada al stock máximo disponible ({$producto->stock} unidades).";
                        $item->cantidad = $producto->stock;
                        $item->save();
                    }
                    $carritoModificado = true;
                }
            }
        }

        if ($carritoModificado) {
            $mensajes = array_merge($sinStockMensajes, $precioActualizadoMensajes);
            session()->flash('error', $mensajes);
            $items = $carrito->items()->with('producto')->get();
        }

        return view('pages.frontend.carrito', compact('items', 'usuario'));
    }

    /**
     * Agrega un producto al carrito de compras.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function agregar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'nullable|integer|min:1'
        ]);

        $productoId = $request->input('producto_id');
        $cantidad = $request->input('cantidad', 1);

        $producto = Producto::findOrFail($productoId);

        if ($producto->stock <= 0) {
            return redirect()->back()->with('error', "El stock de {$producto->nombre} se ha agotado justo antes de que pudieras agregarlo al carrito.");
        }

        if ($producto->stock < $cantidad) {
            return redirect()->back()->with('error', "No hay suficiente stock disponible para {$producto->nombre}. Solo quedan {$producto->stock} unidades.");
        }

        $usuario = Auth::user();
        $carrito = Carrito::firstOrCreate(['usuario_id' => $usuario->id]);
        $item = $carrito->items()->where('producto_id', $productoId)->first();

        // Control de stock agregado al carrito acumulado
        if ($item) {
            if ($item->cantidad + $cantidad > $producto->stock) {
                if ($producto->stock <= 0) {
                    return redirect()->back()->with('error', "El stock de {$producto->nombre} se ha agotado.");
                }
                return redirect()->back()->with('error', "No hay suficiente stock para agregar esa cantidad de {$producto->nombre}. (Stock disponible: {$producto->stock}, en tu carrito: {$item->cantidad}).");
            }
            $item->cantidad += $cantidad;
            $item->precio_unitario = $producto->precio_actual;
            $item->save();
        } else {
            $carrito->items()->create([
                'producto_id' => $productoId,
                'cantidad' => $cantidad,
                'precio_unitario' => $producto->precio_actual
            ]);
        }

        return redirect('/carrito')->with('success', "{$producto->nombre} agregado al carrito.");
    }

    /**
     * Actualiza la cantidad de un ítem en el carrito.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1'
        ]);

        $item = ItemCarrito::findOrFail($id);
        $usuario = Auth::user();
        $carrito = $usuario->carrito;

        if (!$carrito || $item->carrito_id !== $carrito->id) {
            abort(403);
        }

        if ($request->input('cantidad') > $item->producto->stock) {
            return redirect()->back()->with('error', "No hay suficiente stock disponible para {$item->producto->nombre}.");
        }

        $item->cantidad = $request->input('cantidad');
        $item->precio_unitario = $item->producto->precio_actual;
        $item->save();

        return redirect('/carrito')->with('success', "Cantidad de {$item->producto->nombre} actualizada.");
    }

    /**
     * Elimina un ítem del carrito.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function eliminar($id)
    {
        $item = ItemCarrito::findOrFail($id);
        $usuario = Auth::user();
        $carrito = $usuario->carrito;

        if (!$carrito || $item->carrito_id !== $carrito->id) {
            abort(403);
        }

        $nombre = $item->producto->nombre;
        $item->delete();

        return redirect('/carrito')->with('success', "{$nombre} eliminado del carrito.");
    }

    /**
     * Vacía el carrito del usuario.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function vaciar()
    {
        $usuario = Auth::user();
        $carrito = $usuario->carrito;

        if ($carrito) {
            $carrito->items()->delete();
        }

        return redirect('/carrito')->with('success', 'Carrito vaciado con éxito.');
    }

    /**
     * Procesa la compra. Ejecuta transaccionalmente la creación del pedido y decremento de stock.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function comprar(Request $request)
    {
        $request->validate([
            'direccion_envio' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'metodo_pago' => 'required|string|in:Tarjeta,Efectivo,Transferencia',
        ], [
            'direccion_envio.required' => 'La dirección de envío es obligatoria.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'metodo_pago.required' => 'El método de pago es obligatorio.',
            'metodo_pago.in' => 'El método de pago seleccionado no es válido.',
        ]);

        $usuario = Auth::user();
        $carrito = $usuario->carrito;

        if (!$carrito || $carrito->items()->count() === 0) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }

        $items = $carrito->items()->with('producto')->get();

        $precioActualizadoMensajes = [];
        $sinStockMensajes = [];
        $carritoModificado = false;

        // Comprobación de integridad de precios y stock justo antes del guardado definitivo
        foreach ($items as $item) {
            $producto = $item->producto;

            if (is_null($item->precio_unitario)) {
                $item->precio_unitario = $producto->precio_actual;
                $item->save();
            }

            if ($item->precio_unitario != $producto->precio_actual) {
                $precioActualizadoMensajes[] = "El precio de {$producto->nombre} se ha actualizado de $" . number_format($item->precio_unitario, 2) . " a $" . number_format($producto->precio_actual, 2) . ".";
                $item->precio_unitario = $producto->precio_actual;
                $item->save();
                $carritoModificado = true;
            }

            if ($item->cantidad > $producto->stock) {
                if ($producto->stock <= 0) {
                    $sinStockMensajes[] = "El producto {$producto->nombre} ya no tiene stock disponible y ha sido removido de tu carrito.";
                    $item->delete();
                } else {
                    $sinStockMensajes[] = "El stock de {$producto->nombre} ha cambiado. La cantidad en tu carrito fue ajustada al stock máximo disponible ({$producto->stock} unidades).";
                    $item->cantidad = $producto->stock;
                    $item->save();
                }
                $carritoModificado = true;
            }
        }

        if ($carritoModificado) {
            $mensajes = array_merge($sinStockMensajes, $precioActualizadoMensajes);
            return redirect('/carrito')->with('error', $mensajes);
        }

        $usuario->telefono = $request->input('telefono');
        $usuario->save();

        // Procesamiento transaccional de la orden (Atomicidad)
        DB::transaction(function () use ($usuario, $items, $request) {
            $total = 0;
            foreach ($items as $item) {
                $total += $item->producto->precio_actual * $item->cantidad;
            }

            $pedido = Pedido::create([
                'usuario_id' => $usuario->id,
                'estado' => 'pendiente',
                'total' => $total,
                'metodo_pago' => $request->input('metodo_pago'),
                'direccion_envio' => $request->input('direccion_envio'),
            ]);

            foreach ($items as $item) {
                $precio = $item->producto->precio_actual;
                $subtotal = $precio * $item->cantidad;

                DetallePedido::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $item->producto_id,
                    'cantidad' => $item->cantidad,
                    'precio_unitario' => $precio,
                    'subtotal' => $subtotal,
                ]);

                // Descuento de stock en base de datos
                $item->producto->decrement('stock', $item->cantidad);
            }

            $usuario->carrito->items()->delete();
        });

        return redirect('/cliente#pedidos')->with('success', '¡Compra realizada con éxito!');
    }
}
