<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('jwt.verify')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('users', [App\Http\Controllers\UserController::class, 'store']);
Route::post('solicitudes', [App\Http\Controllers\SolicitudController::class, 'store']);
Route::get('mascotas/{id}', [App\Http\Controllers\AnimalController::class, 'show']);
Route::get('mascotas', [App\Http\Controllers\AnimalController::class, 'index']);
Route::get('tipo-animales', [App\Http\Controllers\TipoAnimalController::class, 'index']);
Route::get('contactos', [App\Http\Controllers\ContactoController::class, 'index']);
Route::post('contactos', [App\Http\Controllers\ContactoController::class, 'store']);

Route::group(['middleware' => 'jwt.verify'], function() {   
  Route::post('mascotas', [App\Http\Controllers\AnimalController::class, 'store']);  
});

Route::group(['prefix' => 'auth'], function () {
  Route::post('token', [App\Http\Controllers\AuthController::class, 'login']);
  Route::post('reset-password', [App\Http\Controllers\AuthController::class, 'resetPassword']);
  Route::get('refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
  Route::group(['middleware' => 'jwt.verify'], function() {
    Route::get('me', [App\Http\Controllers\AuthController::class, 'me']);
  });
});