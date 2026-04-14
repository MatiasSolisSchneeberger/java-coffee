<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/quienes-somos', function () {
    return view('quienes-somos');
});

Route::get('/comercialización', function () {
    return view('comercializacion');
});

Route::get('/información-de-contactos', function () {
    return view('informacion-de-contactos');
});

Route::get('/terminos-y-usos', function () {
    return view('terminos-y-usos');
});

Route::get('/catalogo-de-productos', function () {
    return view('catalogo-de-productos');
});

Route::get('/consultas', function () {
    return view('consultas');
});

Route::get('/registro-de-clientes', function () {
    return view('registro-de-clientes');
});

Route::get('/formulario-de-login', function () {
    return view('formulario-de-login');
});
