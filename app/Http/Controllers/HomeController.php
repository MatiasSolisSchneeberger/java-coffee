<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener la ruta del archivo productos.json
        $path = storage_path('app/productos.json');


        $productos = [];
        if (file_exists($path)) {
            $json = file_get_contents($path);

            // Decodificar el json a un array asociativo
            /*
            array asociativo: estructura de datos que almacena pares clave-valor, donde la clave es una cadena personalizada (string) o un número, en lugar de un indice numerico secuencial automático.
            ej ["nombre" => "Juan", "edad" => 25]
            */
            $data = json_decode($json, true);

            // Obtener los primeros 6 productos
            $productos = collect($data['productos'] ?? [])->take(6)->toArray();
        }

        return view('welcome', compact('productos'));
    }
}
