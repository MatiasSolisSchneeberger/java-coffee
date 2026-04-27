<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function procesar(Request $request)
    {
        // Las variables DEBEN estar dentro de las llaves del método
        $nombre = $request->input('nombre');
        $email = $request->input('email');

        // En tu consultas.blade.php el textarea se llama "consulta"
        $mensaje = $request->input('consulta');

        // Retornamos la vista pasando las variables para la personalización
        return view('exito', [
            'nombre' => $nombre,
            'email' => $email
        ]);
    }
}
