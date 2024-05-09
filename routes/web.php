<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', '/admin');

Route::get('/index', [IndexController::class, 'miVista'])->name('index');
