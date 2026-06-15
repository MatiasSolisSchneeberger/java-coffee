<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Pedido;
use App\Models\ProductoFavorito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Controlador para la sección y perfil del cliente registrado.
 */
class ClienteController extends Controller
{
    /**
     * Muestra el panel del cliente. Valida stock y precios del carrito.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $usuario = Auth::user();
        $carrito = $usuario->carrito;

        if ($carrito) {
            $items = $carrito->items()->with('producto')->get();
            $precioActualizadoMensajes = [];
            $sinStockMensajes = [];
            $carritoModificado = false;

            // Validación en tiempo real de stock y precios de ítems en carrito antes de cargar el panel
            foreach ($items as $item) {
                $producto = $item->producto;
                if ($producto) {
                    if (is_null($item->precio_unitario)) {
                        $item->precio_unitario = $producto->precio_actual;
                        $item->save();
                    }

                    if ($item->precio_unitario != $producto->precio_actual) {
                        $precioActualizadoMensajes[] = "El precio de {$producto->nombre} en tu carrito se ha actualizado de $" . number_format($item->precio_unitario, 2) . " a $" . number_format($producto->precio_actual, 2) . ".";
                        $item->precio_unitario = $producto->precio_actual;
                        $item->save();
                        $carritoModificado = true;
                    }

                    if ($item->cantidad > $producto->stock) {
                        if ($producto->stock <= 0) {
                            $sinStockMensajes[] = "El producto {$producto->nombre} ya no tiene stock disponible y fue removido de tu carrito.";
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
            }
        }

        $pedidos = Pedido::where('usuario_id', $usuario->id)
            ->with('detalles.producto')
            ->latest()
            ->get();

        // Mapeo dinámico de favoritos para adaptar las propiedades al formato esperado por la UI
        $favoritos = ProductoFavorito::where('usuario_id', $usuario->id)
            ->with('producto.imagenes')
            ->get()
            ->map(function ($fav) {
                $p = $fav->producto;
                if (! $p) {
                    return null;
                }

                $img = $p->imagenes->first() ? $p->imagenes->first()->url : 'error-404.png';

                return (object) [
                    'id' => $p->id,
                    'nombre' => $p->nombre,
                    'slug' => Str::slug($p->nombre),
                    'descripcion' => $p->descripcion,
                    'precio' => (float) $p->precio,
                    'tipo' => $p->tueste,
                    'imagen' => $img,
                ];
            })
            ->filter()
            ->values();

        $consultas = Consulta::where('usuario_id', $usuario->id)
            ->latest()
            ->get();

        return view('pages.auth.cliente', compact('pedidos', 'favoritos', 'consultas'));
    }

    /**
     * Actualiza los datos del perfil del cliente.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function actualizarPerfil(Request $request)
    {
        $usuario = Auth::user();

        $rules = [
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:usuarios,email,'.$usuario->id,
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'current_password' => 'required_with:password|nullable',
            'password' => 'nullable|string|min:8|confirmed',
        ];

        $messages = [
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser una dirección válida.',
            'email.unique' => 'Este email ya está en uso por otra cuenta.',
            'current_password.required_with' => 'Debes ingresar tu contraseña actual para establecer una nueva.',
            'password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ];

        $request->validate($rules, $messages);

        // Validación de contraseña actual antes de aplicar el hasheo de la nueva
        if ($request->filled('password')) {
            if (! Hash::check($request->current_password, $usuario->password)) {
                return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.'])->withInput();
            }
            $usuario->password = Hash::make($request->password);
        }

        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->email = $request->email;
        $usuario->telefono = $request->telefono;
        $usuario->direccion = $request->direccion;
        $usuario->save();

        return redirect()->back()->with('success', 'Tu perfil ha sido actualizado correctamente.');
    }

    /**
     * Elimina un producto de favoritos.
     *
     * @param int $productoId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function eliminarFavorito($productoId)
    {
        ProductoFavorito::where('usuario_id', Auth::id())
            ->where('producto_id', $productoId)
            ->delete();

        return redirect()->back()->with('success', 'Producto quitado de favoritos.');
    }
}


