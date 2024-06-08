<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/admin/login', '/login');

Route::get('/index', [IndexController::class, 'miVista'])->name('index');
Route::get('/incrementar-casillas', [IndexController::class, 'incrementarCasillas']);
Route::post('/agregar-consola', [IndexController::class, 'agregarConsola']);
Route::post('/mezclar-consolas', [IndexController::class, 'mezclarConsolas']);
Route::post('/intercambiar-consolas', [IndexController::class, 'intercambiarConsolas']);
Route::post('/actualizar-posicion-consola', [IndexController::class, 'actualizarPosicionConsola']);
Route::post('/subir-nivel', [IndexController::class, 'subirNivel']);
Route::post('/actualizar-dinero', [IndexController::class, 'actualizarDinero']);
Route::post('/reiniciar-juego', [IndexController::class, 'reiniciarJuego']);
Route::post('/actualizar-datos', [IndexController::class, 'actualizarDatos']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
