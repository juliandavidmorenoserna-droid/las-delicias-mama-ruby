<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProductoVentaController;
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

// Rutas del módulo de Productos (Carta / Menú del Restaurante)
Route::get('/productos', [ProductoVentaController::class, 'index'])
    ->name('productos.index');

Route::get('/productos/crear', [ProductoVentaController::class, 'create'])
    ->name('productos.crear');

Route::post('/productos', [ProductoVentaController::class, 'store'])
    ->name('productos.guardar');

Route::get('/productos/{producto}', [ProductoVentaController::class, 'show'])
    ->name('productos.ver');

Route::get('/productos/{producto}/editar', [ProductoVentaController::class, 'edit'])
    ->name('productos.editar');

Route::put('/productos/{producto}', [ProductoVentaController::class, 'update'])
    ->name('productos.actualizar');

Route::delete('/productos/{producto}', [ProductoVentaController::class, 'destroy'])
    ->name('productos.eliminar');