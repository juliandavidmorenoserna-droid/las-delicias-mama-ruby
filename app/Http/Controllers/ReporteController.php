<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Empleado;
use App\Models\Pago;
use App\Models\Producto;
use App\Models\ProductoVenta;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    /**
     * Generar informe consolidado del restaurante con métricas e indicadores.
     */
    public function index(Request $request)
    {
        $fechaInicio = $request->query('fecha_inicio');
        $fechaFin = $request->query('fecha_fin');

        // 1. INVENTARIO (Insumos)
        $totalInsumos = Producto::count();
        $insumosAgotados = Producto::where('cantidad', '<=', 0)->count();
        $insumosBajoStock = Producto::where('cantidad', '>', 0)
            ->whereColumn('cantidad', '<=', 'stock_minimo')
            ->count();
        $insumosDisponibles = Producto::whereColumn('cantidad', '>', 'stock_minimo')->count();

        // Lista de insumos con alertas críticas
        $insumosCriticos = Producto::where(function ($q) {
            $q->where('cantidad', '<=', 0)
              ->orWhereColumn('cantidad', '<=', 'stock_minimo');
        })->orderBy('cantidad')->take(10)->get();

        // 2. PRODUCTOS EN VENTA (Menú de platos)
        $totalProductosVenta = ProductoVenta::count();
        $productosVentaDisponibles = ProductoVenta::where('disponible', true)->count();
        $productosVentaAgotados = ProductoVenta::where('disponible', false)->count();

        // 3. VENTAS (con filtro de fechas opcional)
        $ventasQuery = Venta::query();
        $detallesQuery = DetalleVenta::query();

        if (!empty($fechaInicio)) {
            $ventasQuery->whereDate('fecha', '>=', $fechaInicio);
        }
        if (!empty($fechaFin)) {
            $ventasQuery->whereDate('fecha', '<=', $fechaFin);
        }

        $totalVentasMonto = (clone $ventasQuery)->sum('total');
        $cantidadVentas = (clone $ventasQuery)->count();

        // Ventas agrupadas por método de pago
        $ventasPorMetodo = (clone $ventasQuery)
            ->select('metodo_pago', DB::raw('SUM(total) as total_monto'), DB::raw('COUNT(*) as total_transacciones'))
            ->groupBy('metodo_pago')
            ->get();

        // Top 5 productos más vendidos en el periodo
        $topProductos = DetalleVenta::whereHas('venta', function ($q) use ($fechaInicio, $fechaFin) {
            if (!empty($fechaInicio)) {
                $q->whereDate('fecha', '>=', $fechaInicio);
            }
            if (!empty($fechaFin)) {
                $q->whereDate('fecha', '<=', $fechaFin);
            }
        })
        ->select('nombre_producto', DB::raw('SUM(cantidad) as total_vendido'), DB::raw('SUM(subtotal) as total_ingreso'))
        ->groupBy('nombre_producto')
        ->orderByDesc('total_vendido')
        ->take(5)
        ->get();

        // 4. EMPLEADOS Y PAGOS
        $totalEmpleados = Empleado::count();
        $empleadosActivos = Empleado::where('estado', 'Activo')->count();
        $empleadosInactivos = Empleado::where('estado', 'Inactivo')->count();
        $totalNominaMensual = Empleado::where('estado', 'Activo')->sum('salario');

        // Pagos en el periodo seleccionado
        $pagosQuery = Pago::query();
        if (!empty($fechaInicio)) {
            $pagosQuery->whereDate('fecha', '>=', $fechaInicio);
        }
        if (!empty($fechaFin)) {
            $pagosQuery->whereDate('fecha', '<=', $fechaFin);
        }

        $totalPagosRealizados = (clone $pagosQuery)->sum('monto');
        $cantidadPagos = (clone $pagosQuery)->count();

        $pagosPorConcepto = (clone $pagosQuery)
            ->select('concepto', DB::raw('SUM(monto) as total_monto'), DB::raw('COUNT(*) as total_pagos'))
            ->groupBy('concepto')
            ->get();

        // 5. BALANCE OPERATIVO
        $balanceOperativo = $totalVentasMonto - $totalPagosRealizados;

        return view('reportes.index', compact(
            'fechaInicio',
            'fechaFin',
            'totalInsumos',
            'insumosAgotados',
            'insumosBajoStock',
            'insumosDisponibles',
            'insumosCriticos',
            'totalProductosVenta',
            'productosVentaDisponibles',
            'productosVentaAgotados',
            'totalVentasMonto',
            'cantidadVentas',
            'ventasPorMetodo',
            'topProductos',
            'totalEmpleados',
            'empleadosActivos',
            'empleadosInactivos',
            'totalNominaMensual',
            'totalPagosRealizados',
            'cantidadPagos',
            'pagosPorConcepto',
            'balanceOperativo'
        ));
    }
}
