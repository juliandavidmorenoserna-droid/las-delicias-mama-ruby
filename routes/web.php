<?php

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProductoVentaController;
use App\Http\Controllers\VentaController;
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

// Rutas del módulo de Ventas
Route::get('/ventas', [VentaController::class, 'index'])
    ->name('ventas.index');

Route::get('/ventas/crear', [VentaController::class, 'create'])
    ->name('ventas.crear');

Route::post('/ventas', [VentaController::class, 'store'])
    ->name('ventas.guardar');

Route::get('/ventas/{venta}', [VentaController::class, 'show'])
    ->name('ventas.ver');

Route::delete('/ventas/{venta}', [VentaController::class, 'destroy'])
    ->name('ventas.eliminar');

// Rutas del módulo de Empleados
Route::get('/empleados', [EmpleadoController::class, 'index'])
    ->name('empleados.index');

Route::get('/empleados/crear', [EmpleadoController::class, 'create'])
    ->name('empleados.crear');

Route::post('/empleados', [EmpleadoController::class, 'store'])
    ->name('empleados.guardar');

Route::get('/empleados/{empleado}', [EmpleadoController::class, 'show'])
    ->name('empleados.ver');

Route::get('/empleados/{empleado}/editar', [EmpleadoController::class, 'edit'])
    ->name('empleados.editar');

Route::put('/empleados/{empleado}', [EmpleadoController::class, 'update'])
    ->name('empleados.actualizar');

Route::delete('/empleados/{empleado}', [EmpleadoController::class, 'destroy'])
    ->name('empleados.eliminar');

// Rutas del módulo de Pagos
Route::get('/pagos', [PagoController::class, 'index'])
    ->name('pagos.index');

Route::get('/pagos/crear', [PagoController::class, 'create'])
    ->name('pagos.crear');

Route::post('/pagos', [PagoController::class, 'store'])
    ->name('pagos.guardar');

Route::get('/pagos/{pago}', [PagoController::class, 'show'])
    ->name('pagos.ver');

Route::get('/pagos/{pago}/editar', [PagoController::class, 'edit'])
    ->name('pagos.editar');

Route::put('/pagos/{pago}', [PagoController::class, 'update'])
    ->name('pagos.actualizar');

Route::delete('/pagos/{pago}', [PagoController::class, 'destroy'])
    ->name('pagos.eliminar');