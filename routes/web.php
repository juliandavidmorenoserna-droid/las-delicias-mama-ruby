<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rutas del módulo de Inventario
Route::get('/inventario', [ProductoController::class, 'index'])
    ->name('inventario.index');

Route::get('/inventario/crear', [ProductoController::class, 'create'])
    ->name('inventario.crear');

Route::post('/inventario', [ProductoController::class, 'store'])
    ->name('inventario.guardar');

Route::get('/inventario/{producto}', [ProductoController::class, 'show'])
    ->name('inventario.ver');

Route::get('/inventario/{producto}/editar', [ProductoController::class, 'edit'])
    ->name('inventario.editar');

Route::put('/inventario/{producto}', [ProductoController::class, 'update'])
    ->name('inventario.actualizar');

Route::delete('/inventario/{producto}', [ProductoController::class, 'destroy'])
    ->name('inventario.eliminar');