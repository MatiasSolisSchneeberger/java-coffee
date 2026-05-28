<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Cantidad de productos a mostrar por página en el catálogo
    const PRODUCTOS_POR_PAGINA = 6;

    /**
     * Método centralizado para obtener todos los productos.
     */
    public function obtenerProductos()
    {
        $productos = \App\Models\Producto::with(['origen', 'categoria'])->get();
        $imagenes = \App\Models\ImagenProducto::all()->groupBy('producto_id');

        return $productos->map(function ($p) use ($imagenes) {
            $imgs = isset($imagenes[$p->id]) ? $imagenes[$p->id]->pluck('url')->toArray() : [];

            return [
                'id' => $p->id,
                'nombre' => $p->nombre,
                'slug' => \Illuminate\Support\Str::slug($p->nombre),
                'descripcion' => $p->descripcion,
                'precio' => (float) $p->precio,
                'oferta' => $p->oferta ? (float) $p->oferta : 0,
                'tipo' => $p->categoria ? $p->categoria->nombre : ($p->tueste ?? 'Desconocido'),
                'origen' => $p->origen ? $p->origen->nombre : 'Desconocido',
                'imagenes' => $imgs,
            ];
        })->toArray();
    }

    /**
     * Muestra la vista del catálogo con todos los productos y filtros dinámicos.
     */
    public function index(Request $request)
    {
        $categorias = \App\Models\Categoria::all();
        $origenes = \App\Models\Origen::all();

        // Obtener tipos de tueste / presentación únicos
        $tuestes = \App\Models\Producto::whereNotNull('tueste')
            ->where('tueste', '!=', '')
            ->distinct()
            ->pluck('tueste')
            ->toArray();

        // Obtener precios reales para los límites del slider
        $minPrecio = (float) \App\Models\Producto::min('precio') ?: 0;

        // El precio máximo podría ser de oferta o regular, tomamos el mayor precio normal
        $maxPrecio = (float) \App\Models\Producto::max('precio') ?: 10000;

        // Construir query de productos activos
        $query = \App\Models\Producto::with(['origen', 'categoria', 'imagenes'])
            ->where('estado', 'activo');

        // Filtrar por categoría
        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->input('categoria'));
        }

        // Filtrar por origen
        if ($request->filled('origen')) {
            $query->where('origen_id', $request->input('origen'));
        }

        // Filtrar por tueste (presentación)
        if ($request->filled('tueste')) {
            $query->where('tueste', $request->input('tueste'));
        }

        // Filtrar por oferta (en oferta o no)
        if ($request->filled('oferta')) {
            $ofertaVal = $request->input('oferta');
            if ($ofertaVal === '1') {
                $query->whereNotNull('oferta')->where('oferta', '>', 0);
            } elseif ($ofertaVal === '0') {
                $query->where(function ($q) {
                    $q->whereNull('oferta')->orWhere('oferta', '<=', 0);
                });
            }
        }

        // Filtrar por precio máximo, considerando el precio de oferta si está activo
        if ($request->filled('precio_max')) {
            $precioMax = (float) $request->input('precio_max');
            $query->where(function ($q) use ($precioMax) {
                $q->where(function ($sub) use ($precioMax) {
                    $sub->whereNotNull('oferta')
                        ->where('oferta', '>', 0)
                        ->where('oferta', '<=', $precioMax);
                })->orWhere(function ($sub) use ($precioMax) {
                    $sub->where(function ($sub2) {
                        $sub2->whereNull('oferta')
                            ->orWhere('oferta', '<=', 0);
                    })->where('precio', '<=', $precioMax);
                });
            });
        }

        // Paginar los resultados conservando los parámetros de la URL
        $paginador = $query->paginate(self::PRODUCTOS_POR_PAGINA)->withQueryString();

        // Mapear al formato esperado por la vista
        $productos = collect($paginador->items())->map(function ($p) {
            $imgs = $p->imagenes->pluck('url')->toArray();
            return [
                'id' => $p->id,
                'nombre' => $p->nombre,
                'slug' => \Illuminate\Support\Str::slug($p->nombre),
                'descripcion' => $p->descripcion,
                'precio' => (float) $p->precio,
                'oferta' => $p->oferta ? (float) $p->oferta : 0,
                'tipo' => $p->categoria ? $p->categoria->nombre : ($p->tueste ?? 'Desconocido'),
                'origen' => $p->origen ? $p->origen->nombre : 'Desconocido',
                'imagenes' => $imgs,
            ];
        })->toArray();

        return view('pages.frontend.productos', compact(
            'productos',
            'categorias',
            'origenes',
            'tuestes',
            'minPrecio',
            'maxPrecio',
            'paginador'
        ));
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

        // Obtener comentarios de la base de datos que estén aprobados
        $dbComments = \App\Models\Comentario::where('producto_id', $producto['id'])
            ->where('estado', 'aprobado')
            ->with('usuario')
            ->latest()
            ->get();

        $calificaciones = \App\Models\Comentario::where('producto_id', $producto['id'])
            ->where('estado', 'aprobado')
            ->pluck('calificacion');

        $totalCalificaciones = $calificaciones->count();
        $promedio = $totalCalificaciones > 0 ? $calificaciones->average() : 0;

        $comentariosFormateados = $dbComments->map(function ($com) {
            return [
                'calificacion' => $com->calificacion,
                'fecha' => $com->created_at ? $com->created_at->format('Y-m-d') : 'Reciente',
                'titulo' => $com->calificacion >= 4 ? '¡Muy recomendado!' : ($com->calificacion <= 2 ? 'No me convenció' : 'Bueno'),
                'texto' => $com->comentario,
                'usuario_nombre' => $com->usuario ? ($com->usuario->nombre . ' ' . $com->usuario->apellido) : 'Anónimo'
            ];
        })->toArray();

        $producto['comentarios'] = $comentariosFormateados;
        $producto['calificacion_promedio'] = $promedio;
        $producto['calificaciones_count'] = $totalCalificaciones;

        $relacionados = collect($productos)
            ->where('tipo', $producto['tipo'])
            ->where('id', '!=', $producto['id'])
            ->take(4)
            ->values();

        return view('pages.frontend.[producto]', compact('producto', 'relacionados'));
    }

    /**
     * Almacena un nuevo producto en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'categoria_id' => 'required|exists:categorias,id',
            'precio' => 'required|numeric|min:0',
            'oferta' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'origen' => 'nullable|string|max:100',
            'tueste' => 'nullable|string|max:50',
            'peso_gramos' => 'required|integer|min:0',
            'descripcion' => 'required|string',
        ]);

        $origenId = null;
        if ($request->filled('origen')) {
            $origen = \App\Models\Origen::firstOrCreate([
                'nombre' => trim($request->origen)
            ]);
            $origenId = $origen->id;
        }

        $producto = \App\Models\Producto::create([
            'nombre' => $request->nombre,
            'categoria_id' => $request->categoria_id,
            'precio' => $request->precio,
            'oferta' => $request->filled('oferta') ? $request->oferta : null,
            'stock' => $request->stock,
            'origen_id' => $origenId,
            'tueste' => $request->tueste,
            'peso_gramos' => $request->peso_gramos,
            'descripcion' => $request->descripcion,
            'estado' => 'activo',
        ]);

        // Simulación: asociar una imagen por defecto
        \App\Models\ImagenProducto::create([
            'producto_id' => $producto->id,
            'url' => 'error-404.png'
        ]);

        return redirect('/admin/productos')->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Actualiza un producto existente en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'categoria_id' => 'required|exists:categorias,id',
            'precio' => 'required|numeric|min:0',
            'oferta' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'origen' => 'nullable|string|max:100',
            'tueste' => 'nullable|string|max:50',
            'peso_gramos' => 'required|integer|min:0',
            'estado' => 'required|in:activo,inactivo',
            'descripcion' => 'required|string',
        ]);

        $producto = \App\Models\Producto::findOrFail($id);

        $origenId = null;
        if ($request->filled('origen')) {
            $origen = \App\Models\Origen::firstOrCreate([
                'nombre' => trim($request->origen)
            ]);
            $origenId = $origen->id;
        }

        $producto->update([
            'nombre' => $request->nombre,
            'categoria_id' => $request->categoria_id,
            'precio' => $request->precio,
            'oferta' => $request->filled('oferta') ? $request->oferta : null,
            'stock' => $request->stock,
            'origen_id' => $origenId,
            'tueste' => $request->tueste,
            'peso_gramos' => $request->peso_gramos,
            'estado' => $request->estado,
            'descripcion' => $request->descripcion,
        ]);

        return redirect('/admin/productos')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Elimina un producto de la base de datos.
     */
    public function destroy($id)
    {
        $producto = \App\Models\Producto::findOrFail($id);
        $producto->delete();

        return redirect('/admin/productos')->with('success', 'Producto eliminado exitosamente.');
    }
}

