<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\LoginRequest;
use App\Http\Request\RegistroRequest;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Clase AuthController
 * 
 * Controlador que centraliza el proceso de autenticación de la aplicación,
 * incluyendo el registro de usuarios, el inicio de sesión y el cierre seguro de sesión.
 */
class AuthController extends Controller
{
    /**
     * Muestra la vista con el formulario de inicio de sesión (Login).
     *
     * @return \Illuminate\View\View Vista del formulario de Login.
     */
    public function formularioLogin()
    {

        return view('pages.frontend.login');
    }

    /**
     * Muestra la vista con el formulario de registro de nuevos clientes.
     *
     * @return \Illuminate\View\View Vista del formulario de Registro.
     */
    public function formularioRegistro()
    {

        return view('pages.frontend.registro');
    }

    /**
     * Procesa la solicitud de inicio de sesión (Autenticación).
     *
     * @param \App\Http\Request\LoginRequest $request Objeto de solicitud validado con email y password.
     * @return \Illuminate\Http\RedirectResponse Redirección a la sección correspondiente según el rol.
     */
    public function autenticar(LoginRequest $request)
    {

        $credenciales = $request->validated();


        if (Auth::attempt($credenciales)) {

            $request->session()->regenerate();


            if (Auth::user()->rol === 'admin') {
                return redirect('/admin');
            }


            return redirect('/cliente');
        }



        return back()->withErrors([
            'email' => 'Email o contraseña incorrectos',
        ])->onlyInput('email');
    }

    /**
     * Registra un nuevo usuario de tipo Cliente en el sistema.
     *
     * @param \App\Http\Request\RegistroRequest $request Objeto de solicitud validado con datos del cliente.
     * @return \Illuminate\Http\RedirectResponse Redirección al panel del cliente tras el registro exitoso.
     */
    public function registrar(RegistroRequest $request)
    {

        $datos = $request->validated();


        $user = Usuario::create([
            'nombre' => $datos['nombre'],
            'apellido' => $datos['apellido'],
            'email' => $datos['email'],
            'password' => Hash::make($datos['password']),
            'telefono' => $datos['telefono'] ?? null,
            'direccion' => $datos['direccion'] ?? null,
            'rol' => 'cliente'
        ]);


        Auth::login($user);


        return redirect('/cliente');
    }

    /**
     * Cierra de forma segura la sesión del usuario actual en el sistema.
     *
     * @param \Illuminate\Http\Request $request Solicitud HTTP entrante.
     * @return \Illuminate\Http\RedirectResponse Redirección a la landing page pública del sitio.
     */
    public function logout(Request $request)
    {

        Auth::logout();


        $request->session()->invalidate();


        $request->session()->regenerateToken();


        return redirect('/');
    }
}
