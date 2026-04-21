<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Método centralizado para obtener todos los productos.
     * En el futuro, aquí se reemplazará la lectura del JSON por
     * la consulta a la base de datos (por ejemplo: return Producto::all();).
     */
    public function obtenerProductos()
    {
        $path = storage_path('app/productos.json');

        if (file_exists($path)) {
            $json = file_get_contents($path);
            $data = json_decode($json, true);
            
            return $data['productos'] ?? [];
        }

        return [];
    }

    /**
     * Muestra la vista del catálogo con todos los productos.
     */
    public function index()
    {
        $productos = $this->obtenerProductos();
        
        return view('catalogo-de-productos', compact('productos'));
    }

    /**
     * Muestra la vista de un producto específico según su slug.
     */
    public function show($slug)
    {
        $productos = $this->obtenerProductos();
        
        $producto = collect($productos)->firstWhere('slug', $slug);

        if (!$producto) {
            abort(404);
        }

        $relacionados = collect($productos)
            ->where('tipo', $producto['tipo'])
            ->where('id', '!=', $producto['id'])
            ->take(4)
            ->values();

        return view('producto', compact('producto', 'relacionados'));
    }
}
