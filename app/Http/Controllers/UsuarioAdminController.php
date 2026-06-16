<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Provincia;
use Illuminate\Support\Facades\Hash;
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
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        $provincias = Provincia::orderBy('nombre')->get();
        return view('pages.auth.admin.usuarios.crear', compact('provincias'));
    }

    /**
     * Almacena un nuevo usuario.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|string|email|max:150|unique:usuarios,email',
            'password' => 'required|string|min:6',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'provincia_id' => 'nullable|exists:provincias,id',
            'rol' => 'required|string|in:admin,cliente',
            'estado' => 'required|string|in:activo,inactivo',
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'provincia_id' => $request->provincia_id,
            'rol' => $request->rol,
            'estado' => $request->estado,
        ]);

        return redirect('/admin/usuarios')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     */
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        $provincias = Provincia::orderBy('nombre')->get();
        return view('pages.auth.admin.usuarios.editar', compact('usuario', 'provincias'));
    }

    /**
     * Actualiza los datos de un usuario.
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|string|email|max:150|unique:usuarios,email,' . $usuario->id,
            'password' => 'nullable|string|min:6',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'provincia_id' => 'nullable|exists:provincias,id',
            'rol' => 'required|string|in:admin,cliente',
            'estado' => 'required|string|in:activo,inactivo',
        ]);

        $datos = [
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'provincia_id' => $request->provincia_id,
            'rol' => $request->rol,
            'estado' => $request->estado,
        ];

        if ($request->filled('password')) {
            $datos['password'] = Hash::make($request->password);
        }

        $usuario->update($datos);

        return redirect('/admin/usuarios')->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Realiza la baja lógica (desactivación) de un usuario.
     */
    public function delete($id)
    {
        $usuario = Usuario::findOrFail($id);

        // Previene desactivarse a sí mismo
        if (Auth::id() === $usuario->id) {
            return redirect('/admin/usuarios')->with('error', 'No puedes darte de baja a ti mismo.');
        }

        $usuario->estado = 'inactivo';
        $usuario->save();

        return redirect('/admin/usuarios')->with('success', 'Usuario dado de baja exitosamente.');
    }
}
