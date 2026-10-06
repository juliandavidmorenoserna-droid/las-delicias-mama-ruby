<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inventario', [ProductoController::class, 'index'])
    ->name('inventario.index');

Route::get('/inventario/crear', [ProductoController::class, 'create'])
    ->name('inventario.crear');

Route::post('/inventario', [ProductoController::class, 'store'])
    ->name('inventario.guardar');