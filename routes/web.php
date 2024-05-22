<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', '/admin');

Route::get('/index', [IndexController::class, 'miVista'])->name('index');
Route::get('/incrementar-casillas', [IndexController::class, 'incrementarCasillas']);
Route::post('/agregar-consola', [IndexController::class, 'agregarConsola']);
Route::post('/mezclar-consolas', [IndexController::class, 'mezclarConsolas']);
Route::post('/intercambiar-consolas', [IndexController::class, 'intercambiarConsolas']);
Route::post('/actualizar-posicion-consola', [IndexController::class, 'actualizarPosicionConsola']);
Route::post('/subir-nivel', [IndexController::class, 'subirNivel']);

