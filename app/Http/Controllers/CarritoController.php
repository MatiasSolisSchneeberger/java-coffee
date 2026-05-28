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

class CarritoController extends Controller
{
    /**
     * Muestra la vista del carrito.
     */
    public function index()
    {
        $usuario = Auth::user();
        $carrito = Carrito::firstOrCreate(['usuario_id' => $usuario->id]);
        $items = $carrito->items()->with('producto')->get();

        return view('pages.frontend.carrito', compact('items', 'usuario'));
    }

    /**
     * Agrega un producto al carrito.
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

        if ($producto->stock < $cantidad) {
            return redirect()->back()->with('error', "No hay suficiente stock disponible para {$producto->nombre}.");
        }

        $usuario = Auth::user();
        $carrito = Carrito::firstOrCreate(['usuario_id' => $usuario->id]);

        $item = $carrito->items()->where('producto_id', $productoId)->first();

        if ($item) {
            if ($item->cantidad + $cantidad > $producto->stock) {
                return redirect()->back()->with('error', "No hay suficiente stock para agregar esa cantidad de {$producto->nombre}.");
            }
            $item->cantidad += $cantidad;
            $item->save();
        } else {
            $carrito->items()->create([
                'producto_id' => $productoId,
                'cantidad' => $cantidad
            ]);
        }

        return redirect('/carrito')->with('success', "{$producto->nombre} agregado al carrito.");
    }

    /**
     * Actualiza la cantidad de un ítem del carrito.
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
        $item->save();

        return redirect('/carrito')->with('success', "Cantidad de {$item->producto->nombre} actualizada.");
    }

    /**
     * Elimina un ítem del carrito.
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
     * Vacía el carrito del cliente.
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
     * Procesa la compra (checkout).
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

        // Validar stock antes de empezar la transacción
        foreach ($items as $item) {
            if ($item->cantidad > $item->producto->stock) {
                return redirect()->back()->with('error', "No hay suficiente stock de {$item->producto->nombre} para completar la compra.");
            }
        }

        // Actualizar el teléfono en el perfil del usuario (según indicaciones)
        $usuario->telefono = $request->input('telefono');
        $usuario->save();

        // Crear pedido y detalles en transacción
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

                // Descontar stock
                $item->producto->decrement('stock', $item->cantidad);
            }

            // Vaciar el carrito
            $usuario->carrito->items()->delete();
        });

        return redirect('/cliente#pedidos')->with('success', '¡Compra realizada con éxito!');
    }
}
