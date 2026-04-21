<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Instanciamos ProductoController para aprovechar su método obtenerProductos()
        // Cuando en el futuro se conecte a BD, obtenerProductos() internamente traerá datos de allí.
        $productoController = new ProductoController();
        $todosLosProductos = $productoController->obtenerProductos();

        // Obtener los primeros 6 productos para mostrar en el inicio
        $productos = collect($todosLosProductos)->take(6)->toArray();

        return view('welcome', compact('productos'));
    }
}
