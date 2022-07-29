<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('inicio');
});

Route::get('/inicio', function () {
    return view('inicio');
});

Route::get('/registrar', function () {
    return view('registrar-usuario');
});

Route::get('/ingresar', function () {
    return view('iniciar-sesion');
});

Route::get('/registrar-mascota', function () {
    return view('registrar-mascota');
});

Route::get('/solicitar-mascota/{id}', function () {
    return view('solicitar-mascota');
});

Route::get('/contactos', function () {
    return view('contactos');
});

Route::get('/registrar-contacto', function () {
    return view('registrar-contacto');
});


