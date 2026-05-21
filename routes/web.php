<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarritoController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/quienes-somos', function () {
    return view('quienes-somos');
});

Route::get('/comercializacion', function () {
    return view('comercializacion');
});


Route::get('/contacto', function () {
    return view('informacion-de-contactos');
});

Route::post('/contacto', [ContactoController::class, 'procesar']);


Route::get('/terminos-y-usos', function () {
    return view('terminos-y-usos');
});

Route::get('/productos', [ProductoController::class, 'index']);

Route::get('/consultas', function () {
    return view('consultas');
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
        return view('backend.admin.dashboard');
    });
});

Route::middleware(['auth', 'rol:cliente'])->group(function () {
    Route::get('/cliente', function () {
        return view('backend.usuarios.cliente');
    });

    Route::get('/carrito', [CarritoController::class, 'index']);
    Route::post('/carrito/agregar', [CarritoController::class, 'agregar']);
    Route::patch('/carrito/actualizar/{id}', [CarritoController::class, 'actualizar']);
    Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar']);
    Route::post('/carrito/comprar', [CarritoController::class, 'comprar']);
    
    Route::get('/pedidos', function () {
        return view('pedidos');
    });
});

// {slug} toma lo que se escribe despues de producto y lo manda al controlador.
Route::get('/producto/{slug}', [ProductoController::class, 'show']);

Route::post('/consultas', [ContactoController::class, 'store_contact']);
