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
        $productos = \App\Models\Producto::all();
        $imagenes = \App\Models\ImagenProducto::all()->groupBy('producto_id');

        return $productos->map(function ($p) use ($imagenes) {
            $imgs = isset($imagenes[$p->id]) ? $imagenes[$p->id]->pluck('url')->toArray() : [];

            return [
                'id' => $p->id,
                'nombre' => $p->nombre,
                'slug' => \Illuminate\Support\Str::slug($p->nombre),
                'descripcion' => $p->descripcion,
                'precio' => (float) $p->precio,
                'oferta' => 0, // Por defecto no hay oferta en la BD actualmente
                'tipo' => $p->tueste,
                'imagenes' => $imgs,
            ];
        })->toArray();
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
