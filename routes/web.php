<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [IndexController::class, 'index'])->name('index');
