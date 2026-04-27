<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\AuthController;

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

Route::post('/consultas', [ContactoController::class, 'procesar']);


Route::get('/registro', function () {
    return view('registro-de-clientes');
});

Route::post('/registro', [AuthController::class, 'register']);

Route::get('/login', function () {
    return view('formulario-de-login');
});

Route::post('/login', [AuthController::class, 'login']);

// {slug} toma lo que se escribe despues de producto y lo manda al controlador.
Route::get('/producto/{slug}', [ProductoController::class, 'show']);
