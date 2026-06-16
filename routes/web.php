<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioAdminController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/quienes-somos', function () {
    return view('pages.frontend.quienes-somos');
});

Route::get('/comercializacion', function () {
    return view('pages.frontend.comercializacion');
});


Route::get('/contacto', function () {
    return view('pages.frontend.contactos');
});

Route::post('/contacto', [ContactoController::class, 'procesar']);


Route::get('/terminos-y-usos', function () {
    return view('pages.frontend.terminos-y-usos');
});

Route::get('/productos', [ProductoController::class, 'index']);

Route::get('/consultas', function () {
    return view('pages.frontend.consultas');
});




Route::middleware('guest')->group(function () {
    Route::get('/registro', [AuthController::class, 'formularioRegistro']);
    Route::post('/registro', [AuthController::class, 'registrar']);

    Route::get('/login', [AuthController::class, 'formularioLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'autenticar']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');


Route::middleware(['auth', 'rol:admin'])->group(function () {
    Route::get('/admin', function () {
        $totalVentas = \App\Models\Pedido::where('estado', 'entregado')->sum('total');
        $pedidosPendientes = \App\Models\Pedido::where('estado', 'pendiente')->count();
        $consultasActivas = \App\Models\Consulta::where('estado', 'no leido')->count();
        $comentariosNuevos = \App\Models\Comentario::where('estado', 'pendiente')->count();
        $stockCritico = \App\Models\Producto::where('stock', '<', 5)->count();

        $pedidos = \App\Models\Pedido::with('usuario')->latest()->take(4)->get();
        $comentarios = \App\Models\Comentario::with(['usuario', 'producto'])->latest()->take(3)->get();

        return view('pages.auth.admin.dashboard', compact(
            'totalVentas',
            'pedidosPendientes',
            'consultasActivas',
            'comentariosNuevos',
            'stockCritico',
            'pedidos',
            'comentarios'
        ));
    });

    Route::get('/admin/productos', function () {
        $productos = \App\Models\Producto::with(['categoria', 'origen', 'imagenes'])->get();
        return view('pages.auth.admin.productos.index', compact('productos'));
    });

    Route::post('/admin/productos', [ProductoController::class, 'store']);
    Route::put('/admin/productos/{id}', [ProductoController::class, 'update']);
    Route::delete('/admin/productos/{id}', [ProductoController::class, 'destroy']);

    Route::get('/admin/producto/crear', function () {
        $categorias = \App\Models\Categoria::all();
        $origenes = \App\Models\Origen::all();
        return view('pages.auth.admin.productos.crear', compact('categorias', 'origenes'));
    });

    Route::get('/admin/producto/{slug}', function ($slug) {
        // Map slug to product
        $producto = \App\Models\Producto::with(['categoria', 'origen'])->get()->first(function ($p) use ($slug) {
            return \Illuminate\Support\Str::slug($p->nombre) === $slug;
        });

        $categorias = \App\Models\Categoria::all();
        $origenes = \App\Models\Origen::all();

        return view('pages.auth.admin.productos.editar', compact('slug', 'producto', 'categorias', 'origenes'));
    });

    Route::get('/admin/pedidos', function (\Illuminate\Http\Request $request) {
        $estado = $request->query('estado');
        $query = \App\Models\Pedido::with(['usuario', 'provincia', 'detalles.producto'])->latest();

        if ($estado && $estado !== 'todos') {
            $query->where('estado', $estado);
        }

        $pedidos = $query->get();
        return view('pages.auth.admin.pedidos.index', compact('pedidos', 'estado'));
    });

    Route::get('/admin/consultas', function (\Illuminate\Http\Request $request) {
        $estado = $request->query('estado');
        $query = \App\Models\Consulta::latest();

        if ($estado === 'pendientes') {
            $query->where('estado', '!=', 'respondido');
        } elseif ($estado === 'respondidas') {
            $query->where('estado', 'respondido');
        }

        $consultas = $query->get();
        return view('pages.auth.admin.consultas.index', compact('consultas', 'estado'));
    });

    Route::get('/admin/comentarios', function (\Illuminate\Http\Request $request) {
        $estado = $request->query('estado');
        $query = \App\Models\Comentario::with(['usuario', 'producto'])->latest();

        if ($estado && $estado !== 'todos') {
            if ($estado === 'pendientes') {
                $query->where('estado', 'pendiente');
            } elseif ($estado === 'aprobados') {
                $query->where('estado', 'aprobado');
            } elseif ($estado === 'rechazados') {
                $query->where('estado', 'rechazado');
            }
        }

        $comentarios = $query->get();
        return view('pages.auth.admin.comentarios.index', compact('comentarios', 'estado'));
    });

    Route::patch('/admin/comentarios/{id}/aprobar', function ($id) {
        $comentario = \App\Models\Comentario::findOrFail($id);
        $comentario->estado = 'aprobado';
        $comentario->save();

        return response()->json([
            'success' => true,
            'message' => 'Comentario aprobado con éxito.'
        ]);
    });

    Route::delete('/admin/comentarios/{id}', function ($id) {
        $comentario = \App\Models\Comentario::findOrFail($id);
        $comentario->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comentario eliminado con éxito.'
        ]);
    });

    Route::get('/admin/usuarios', [UsuarioAdminController::class, 'index']);
    Route::get('/admin/usuarios/{id}/editar', [UsuarioAdminController::class, 'edit']);
    Route::put('/admin/usuarios/{id}', [UsuarioAdminController::class, 'update']);
    Route::patch('/admin/usuarios/{id}/baja', [UsuarioAdminController::class, 'delete']);

    Route::patch('/admin/pedidos/{id}/status', function (\Illuminate\Http\Request $request, $id) {
        $request->validate([
            'estado' => 'required|in:pendiente,preparando,enviado,entregado,cancelado'
        ]);

        $pedido = \App\Models\Pedido::findOrFail($id);
        $pedido->estado = $request->input('estado');
        $pedido->save();

        return response()->json([
            'success' => true,
            'message' => "El pedido #{$id} cambió al estado: " . strtoupper($pedido->estado)
        ]);
    });

    Route::patch('/admin/consultas/{id}/status', function (\Illuminate\Http\Request $request, $id) {
        $request->validate([
            'estado' => 'required|in:pendiente,no leido,respondido',
            'respuesta' => 'required|string'
        ]);

        $consulta = \App\Models\Consulta::findOrFail($id);
        $consulta->estado = $request->input('estado');
        $consulta->respuesta = $request->input('respuesta');
        $consulta->save();

        return response()->json([
            'success' => true,
            'message' => "La consulta se actualizó correctamente."
        ]);
    });
});

Route::middleware(['auth', 'rol:cliente'])->group(function () {
    Route::get('/cliente', [ClienteController::class, 'index']);
    Route::post('/producto/{slug}/calificar', [App\Http\Controllers\ProductoController::class, 'storeComment']);
    Route::put('/cliente/perfil', [ClienteController::class, 'actualizarPerfil']);
    Route::patch('/cliente/perfil/actualizar-campo', [ClienteController::class, 'actualizarCampoRapido']);
    Route::delete('/cliente/favoritos/eliminar/{id}', [ClienteController::class, 'eliminarFavorito']);

    Route::get('/carrito', [CarritoController::class, 'index']);
    Route::post('/carrito/agregar', [CarritoController::class, 'agregar']);
    Route::patch('/carrito/actualizar/{id}', [CarritoController::class, 'actualizar']);
    Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar']);
    Route::delete('/carrito/vaciar', [CarritoController::class, 'vaciar']);
    Route::post('/carrito/comprar', [CarritoController::class, 'comprar']);

    Route::redirect('/pedidos', '/cliente#pedidos');
});


// {slug} toma lo que se escribe despues de producto y lo manda al controlador.
Route::get('/producto/{slug}', [ProductoController::class, 'show']);

Route::post('/consultas', [ContactoController::class, 'store_contact']);
