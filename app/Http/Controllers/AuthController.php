<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\LoginRequest;
use App\Http\Request\RegistroRequest;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function formularioLogin()
    {
        return view('backend.usuarios.login');
    }

    public function formularioRegistro()
    {
        return view('backend.usuarios.registro');
    }

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

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
