<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        
        // As we are just mocking the behavior like ContactoController
        return view('exito', [
            'nombre' => 'Usuario',
            'email' => $email
        ]);
    }

    public function register(Request $request)
    {
        $nombre = $request->input('nombre');
        $email = $request->input('email');

        return view('exito', [
            'nombre' => $nombre,
            'email' => $email
        ]);
    }
}
