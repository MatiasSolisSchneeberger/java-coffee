<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Pedido;
use App\Models\ProductoFavorito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClienteController extends Controller
{
    /**
     * Muestra el panel de control del cliente con sus datos reales.
     */
    public function index()
    {
        $usuario = Auth::user();

        // Obtener pedidos del usuario con sus detalles e información de productos
        $pedidos = Pedido::where('usuario_id', $usuario->id)
            ->with('detalles.producto')
            ->latest()
            ->get();

        // Obtener favoritos del usuario formateados para que coincidan con la vista
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

        // Obtener consultas enviadas por el usuario
        $consultas = Consulta::where('usuario_id', $usuario->id)
            ->latest()
            ->get();

        return view('pages.auth.cliente', compact('pedidos', 'favoritos', 'consultas'));
    }

    /**
     * Actualiza la información del perfil del cliente.
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

        // Lógica de cambio de contraseña
        if ($request->filled('password')) {
            if (! Hash::check($request->current_password, $usuario->password)) {
                return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.'])->withInput();
            }
            $usuario->password = Hash::make($request->password);
        }

        // Actualizar datos de contacto y envío
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->email = $request->email;
        $usuario->telefono = $request->telefono;
        $usuario->direccion = $request->direccion;
        $usuario->save();

        return redirect()->back()->with('success', 'Tu perfil ha sido actualizado correctamente.');
    }

    /**
     * Elimina un producto de la lista de favoritos del cliente.
     */
    public function eliminarFavorito($productoId)
    {
        ProductoFavorito::where('usuario_id', Auth::id())
            ->where('producto_id', $productoId)
            ->delete();

        return redirect()->back()->with('success', 'Producto quitado de favoritos.');
    }
}
