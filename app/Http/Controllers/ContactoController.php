<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\ContactoRequest;

/**
 * Controlador para gestionar el envío de mensajes de contacto y consultas.
 */
class ContactoController extends Controller
{
    /**
     * Procesa la solicitud POST del formulario simple de contacto (sin persistencia).
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function procesar(Request $request)
    {
        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $mensaje = $request->input('consulta');

        return view('pages.frontend.exito', [
            'nombre' => $nombre,
            'email' => $email
        ]);
    }

    /**
     * Almacena una consulta formal en la base de datos.
     *
     * @param \App\Http\Request\ContactoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store_contact(ContactoRequest $request)
    {
        $datos = $request->validated();

        // Persistencia física de la consulta enviada
        \App\Models\Consulta::create([
            'usuario_id' => auth()->id(), 
            'nombre'     => $datos['nombre'],
            'email'      => $datos['email'],
            'asunto'     => $datos['motivo'],
            'mensaje'    => $datos['consulta'],
            'estado'     => 'no leido',
        ]);

        return redirect()->back()->with('success_message', 'Tu consulta ha sido enviada correctamente');
    }
}


