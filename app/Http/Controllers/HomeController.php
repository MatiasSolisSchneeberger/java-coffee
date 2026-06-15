<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controlador para la página de inicio (welcome).
 */
class HomeController extends Controller
{
    /**
     * Muestra la landing page con 6 productos destacados.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $productoController = new ProductoController();
        $todosLosProductos = $productoController->obtenerProductos();

        $productos = collect($todosLosProductos)->take(6)->toArray();

        return view('pages.frontend.welcome', compact('productos'));
    }
}


