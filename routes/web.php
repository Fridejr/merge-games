<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/admin/login', '/login');

Route::get('/index', [IndexController::class, 'miVista'])->name('index');
Route::post('/reiniciar-juego', [IndexController::class, 'reiniciarJuego']);
Route::post('/actualizar-datos', [IndexController::class, 'actualizarDatos']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
