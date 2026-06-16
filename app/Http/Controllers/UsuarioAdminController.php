<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

class UsuarioAdminController extends Controller
{
    /**
     * Muestra la lista de usuarios.
     */
    public function index(Request $request)
    {
        $buscar = $request->query('buscar');
        $rol = $request->query('rol');
        $estado = $request->query('estado');

        $query = Usuario::with('provincia')->latest();

        if ($buscar) {
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('apellido', 'like', "%{$buscar}%")
                  ->orWhere('email', 'like', "%{$buscar}%");
            });
        }

        if ($rol) {
            $query->where('rol', $rol);
        }

        if ($estado) {
            $query->where('estado', $estado);
        }

        $usuarios = $query->get();

        return view('pages.auth.admin.usuarios.index', compact('usuarios', 'buscar', 'rol', 'estado'));
    }

    /**
     * Muestra el formulario para editar el estado de un usuario existente.
     */
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('pages.auth.admin.usuarios.editar', compact('usuario'));
    }

    /**
     * Actualiza únicamente el estado de un usuario.
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'estado' => 'required|string|in:activo,baneado',
        ]);

        // Previene cambiarse a sí mismo a baneado
        if (Auth::id() === $usuario->id && $request->estado !== 'activo') {
            return redirect('/admin/usuarios')->with('error', 'No puedes cambiar tu propio estado a inactivo o baneado.');
        }

        $usuario->update([
            'estado' => $request->estado,
        ]);

        return redirect('/admin/usuarios')->with('success', 'Estado del usuario actualizado exitosamente.');
    }

    /**
     * Realiza la baja lógica (banear) de un usuario.
     */
    public function delete($id)
    {
        $usuario = Usuario::findOrFail($id);

        // Previene banearse a sí mismo
        if (Auth::id() === $usuario->id) {
            return redirect('/admin/usuarios')->with('error', 'No puedes banearte a ti mismo.');
        }

        $usuario->estado = 'baneado';
        $usuario->save();

        return redirect('/admin/usuarios')->with('success', 'Usuario baneado exitosamente.');
    }
}
