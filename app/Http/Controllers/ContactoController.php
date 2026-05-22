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

        \App\Models\Consulta::create([
            'usuario_id' => auth()->id(), // Asocia el id de usuario si está logueado
            'nombre'     => $datos['nombre'],
            'email'      => $datos['email'],
            'asunto'     => $datos['motivo'],
            'mensaje'    => $datos['consulta'],
            'estado'     => 'no leido', // Estado inicial
        ]);

        return redirect()->back()->with('success_message', 'Tu consulta ha sido enviada correctamente');
    }
}
