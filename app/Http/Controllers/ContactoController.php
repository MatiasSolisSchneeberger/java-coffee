<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\ContactoRequest;

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

    public function store_contact(ContactoRequest $request)
    {

        $datos = $request->validated();

        $nombre   = $datos['nombre'];
        $email    = $datos['email'];
        $motivo   = $datos['motivo'];
        $consulta = $datos['consulta'];

        // guardar en BD

        return redirect()->back()->with('success_message', 'Tu consulta ha sido enviada correctamente');
    }
}
