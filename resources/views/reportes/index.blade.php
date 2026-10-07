<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reportes y Estadísticas - Las Delicias de Mamá Ruby</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #fffaf2;
            color: #4b2418;
        }

        header {
            background: white;
            padding: 20px;
            text-align: center;
            border-bottom: 4px solid #f2c94c;
        }

        header img {
            width: 180px;
            max-width: 80%;
        }

        .contenedor {
            width: 92%;
            max-width: 1150px;
            margin: 40px auto;
        }

        .encabezado {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        h1 {
            color: #d63384;
            font-size: 32px;
        }

        .subtitulo {
            margin-top: 8px;
            color: #555;
        }

        .boton {
            display: inline-block;
            background: #d63384;
            color: white;
            text-decoration: none;
            padding: 12px 22px;
            border-radius: 10px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .boton:hover {
            background: #b82b70;
        }

        .boton-secundario {
            background: #3b82c4;
        }

        .boton-secundario:hover {
            background: #2d6fa8;
        }

        /* FILTROS */
        .filtros-box {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .filtros-form {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .filtros-form label {
            font-size: 13px;
            font-weight: bold;
            color: #4b2418;
        }

        .filtros-form input {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        .btn-filtrar {
            background: #3b82c4;
            color: white;
            border: none;
            padding: 9px 18px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-limpiar {
            background: #e2e8f0;
            color: #4b2418;
            text-decoration: none;
            padding: 9px 15px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: bold;
        }

        /* GRID KPIS PRINCIPALES */
        .kpis-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 35px;
        }

        .kpi-card {
            background: white;
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
            border-left: 5px solid #d63384;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .kpi-card.verde {
            border-left-color: #2e7d32;
        }

        .kpi-card.azul {
            border-left-color: #3b82c4;
        }

        .kpi-card.dorado {
            border-left-color: #d4a017;
        }

        .kpi-titulo {
            font-size: 13px;
            color: #666;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .kpi-valor {
            font-size: 24px;
            font-weight: bold;
            color: #4b2418;
        }

        .kpi-sub {
            font-size: 12px;
            color: #888;
            margin-top: 5px;
        }

        /* SECCIONES DEL REPORTE */
        .seccion-reporte {
            background: white;
            padding: 28px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
            margin-bottom: 30px;
        }

        .seccion-cabecera {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #fffaf2;
            padding-bottom: 12px;
        }

        .seccion-titulo {
            color: #244a73;
            font-size: 20px;
            font-weight: bold;
        }

        /* SUB-GRID PARA ESTADOS */
        .estados-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .estado-box {
            padding: 15px;
            border-radius: 10px;
            text-align: center;
        }

        .estado-box .numero {
            font-size: 26px;
            font-weight: bold;
            margin-top: 5px;
        }

        .box-verde {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .box-amarillo {
            background: #fff8e1;
            color: #f57f17;
        }

        .box-rojo {
            background: #ffebee;
            color: #c62828;
        }

        .box-azul {
            background: #e3f2fd;
            color: #1565c0;
        }

        /* TABLAS DE REPORTE */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background: #244a73;
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 13px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        tr:hover {
            background: #fffaf2;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-rojo {
            background: #ffebee;
            color: #c62828;
        }

        .badge-amarillo {
            background: #fff8e1;
            color: #f57f17;
        }

        .badge-verde {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .grid-dos-columnas {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        .volver {
            margin-top: 25px;
        }

        @media (max-width: 900px) {
            .kpis-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .estados-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .grid-dos-columnas {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .kpis-grid {
                grid-template-columns: 1fr;
            }
            .estados-grid {
                grid-template-columns: 1fr;
            }
        }

        @media print {
            header, .filtros-box, .volver, .boton-imprimir {
                display: none !important;
            }
            body {
                background: white;
            }
            .seccion-reporte, .kpi-card {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }
    </style>
</head>

<body>

    <header>
        <img
            src="{{ asset('imagenes/logo.png') }}"
            alt="Logo Las Delicias de Mamá Ruby"
        >
    </header>

    <main class="contenedor">

        <div class="encabezado">

            <div>
                <h1>Reportes Generales del Restaurante</h1>

                <p class="subtitulo">
                    Métricas de inventario, ventas, nómina y balance operativo
                </p>
            </div>

            <button onclick="window.print()" class="boton boton-secundario boton-imprimir">
                🖨️ Imprimir Reporte
            </button>

        </div>

        <!-- FILTROS POR FECHA -->
        <div class="filtros-box">
            <form action="{{ route('reportes.index') }}" method="GET" class="filtros-form">

                <div>
                    <label>Desde:</label>
                    <input type="date" name="fecha_inicio" value="{{ $fechaInicio }}">
                </div>

                <div>
                    <label>Hasta:</label>
                    <input type="date" name="fecha_fin" value="{{ $fechaFin }}">
                </div>

                <button type="submit" class="btn-filtrar">
                    Filtrar por periodo
                </button>

                @if(!empty($fechaInicio) || !empty($fechaFin))
                    <a href="{{ route('reportes.index') }}" class="btn-limpiar">
                        Ver histórico completo
                    </a>
                @endif

            </form>

            <div style="font-size: 13px; color: #666;">
                @if(!empty($fechaInicio) || !empty($fechaFin))
                    Periodo: {{ $fechaInicio ?: 'Inicio' }} al {{ $fechaFin ?: 'Hoy' }}
                @else
                    Mostrando información acumulada total
                @endif
            </div>
        </div>

        <!-- TARJETAS PRINCIPALES DE RENDIMIENTO (KPIs) -->
        <div class="kpis-grid">

            <div class="kpi-card verde">
                <span class="kpi-titulo">Ingresos por Ventas</span>
                <span class="kpi-valor">${{ number_format($totalVentasMonto, 2) }}</span>
                <span class="kpi-sub">{{ $cantidadVentas }} ventas registradas</span>
            </div>

            <div class="kpi-card">
                <span class="kpi-titulo">Gastos en Nómina</span>
                <span class="kpi-valor">${{ number_format($totalPagosRealizados, 2) }}</span>
                <span class="kpi-sub">{{ $cantidadPagos }} pagos efectuados</span>
            </div>

            <div class="kpi-card dorado">
                <span class="kpi-titulo">Margen Operativo</span>
                <span class="kpi-valor" style="color: {{ $balanceOperativo >= 0 ? '#2e7d32' : '#c62828' }}">
                    ${{ number_format($balanceOperativo, 2) }}
                </span>
                <span class="kpi-sub">Ventas menos pagos de nómina</span>
            </div>

            <div class="kpi-card azul">
                <span class="kpi-titulo">Insumos y Platos</span>
                <span class="kpi-valor">{{ $totalInsumos + $totalProductosVenta }}</span>
                <span class="kpi-sub">{{ $totalInsumos }} insumos / {{ $totalProductosVenta }} platos</span>
            </div>

        </div>

        <!-- SECCIÓN 1: INVENTARIO DE INSUMOS -->
        <section class="seccion-reporte">

            <div class="seccion-cabecera">
                <h2 class="seccion-titulo">📦 Estado del Inventario de Cocina</h2>
                <a href="{{ route('inventario.index') }}" style="color: #3b82c4; font-size: 14px; text-decoration: none; font-weight: bold;">
                    Ver inventario completo →
                </a>
            </div>

            <div class="estados-grid">
                <div class="estado-box box-azul">
                    <div>Total Insumos</div>
                    <div class="numero">{{ $totalInsumos }}</div>
                </div>
                <div class="estado-box box-verde">
                    <div>Disponibles</div>
                    <div class="numero">{{ $insumosDisponibles }}</div>
                </div>
                <div class="estado-box box-amarillo">
                    <div>Stock Bajo</div>
                    <div class="numero">{{ $insumosBajoStock }}</div>
                </div>
                <div class="estado-box box-rojo">
                    <div>Agotados</div>
                    <div class="numero">{{ $insumosAgotados }}</div>
                </div>
            </div>

            @if($insumosCriticos->count() > 0)
                <h3 style="font-size: 15px; margin-top: 15px; margin-bottom: 10px; color: #4b2418;">
                    ⚠️ Insumos que requieren reposición urgente:
                </h3>
                <table>
                    <thead>
                        <tr>
                            <th>Insumo</th>
                            <th>Categoría</th>
                            <th>Cantidad actual</th>
                            <th>Stock mínimo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($insumosCriticos as $ins)
                            <tr>
                                <td><strong>{{ $ins->nombre }}</strong></td>
                                <td>{{ $ins->categoria }}</td>
                                <td>{{ $ins->cantidad }} {{ $ins->unidad }}</td>
                                <td>{{ $ins->stock_minimo }} {{ $ins->unidad }}</td>
                                <td>
                                    @if($ins->cantidad <= 0)
                                        <span class="badge badge-rojo">Agotado</span>
                                    @else
                                        <span class="badge badge-amarillo">Stock bajo</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #2e7d32; font-size: 14px;">
                    ✅ Todo el inventario se encuentra en niveles óptimos de stock.
                </p>
            @endif

        </section>

        <!-- SECCIÓN 2: VENTAS Y PRODUCTOS MÁS VENDIDOS -->
        <section class="seccion-reporte">

            <div class="seccion-cabecera">
                <h2 class="seccion-titulo">💳 Análisis de Ventas y Comandas</h2>
                <a href="{{ route('ventas.index') }}" style="color: #3b82c4; font-size: 14px; text-decoration: none; font-weight: bold;">
                    Ver historial de ventas →
                </a>
            </div>

            <div class="grid-dos-columnas">

                <!-- Desglose por método de pago -->
                <div>
                    <h3 style="font-size: 15px; margin-bottom: 10px; color: #244a73;">
                        Recaudación por Método de Pago
                    </h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Método de pago</th>
                                <th>Ventas</th>
                                <th>Total recaudado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ventasPorMetodo as $vMetodo)
                                <tr>
                                    <td><strong>{{ $vMetodo->metodo_pago }}</strong></td>
                                    <td>{{ $vMetodo->total_transacciones }}</td>
                                    <td><strong>${{ number_format($vMetodo->total_monto, 2) }}</strong></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" style="text-align: center; color: #888;">Sin ventas en el periodo.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Top productos más vendidos -->
                <div>
                    <h3 style="font-size: 15px; margin-bottom: 10px; color: #244a73;">
                        Platos / Bebidas Más Vendidos
                    </h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad vendida</th>
                                <th>Total ingresos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topProductos as $top)
                                <tr>
                                    <td><strong>{{ $top->nombre_producto }}</strong></td>
                                    <td>{{ $top->total_vendido }} und</td>
                                    <td><strong>${{ number_format($top->total_ingreso, 2) }}</strong></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" style="text-align: center; color: #888;">Sin productos vendidos en el periodo.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </section>

        <!-- SECCIÓN 3: TALENTO HUMANO Y PAGOS -->
        <section class="seccion-reporte">

            <div class="seccion-cabecera">
                <h2 class="seccion-titulo">👥 Empleados y Desembolsos de Nómina</h2>
                <a href="{{ route('pagos.index') }}" style="color: #3b82c4; font-size: 14px; text-decoration: none; font-weight: bold;">
                    Ver detalles de nómina →
                </a>
            </div>

            <div class="grid-dos-columnas">

                <div>
                    <h3 style="font-size: 15px; margin-bottom: 10px; color: #244a73;">
                        Estado del Personal
                    </h3>
                    <table>
                        <tbody>
                            <tr>
                                <td>Total de empleados registrados:</td>
                                <td><strong>{{ $totalEmpleados }}</strong></td>
                            </tr>
                            <tr>
                                <td>Empleados activos:</td>
                                <td><span class="badge badge-verde">{{ $empleadosActivos }} activos</span></td>
                            </tr>
                            <tr>
                                <td>Empleados inactivos:</td>
                                <td><span class="badge badge-rojo">{{ $empleadosInactivos }} inactivos</span></td>
                            </tr>
                            <tr>
                                <td>Nómina mensual presupuestada activa:</td>
                                <td><strong>${{ number_format($totalNominaMensual, 2) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div>
                    <h3 style="font-size: 15px; margin-bottom: 10px; color: #244a73;">
                        Desglose de Pagos Efectuados
                    </h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Concepto</th>
                                <th>Pagos</th>
                                <th>Total abonado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pagosPorConcepto as $pCon)
                                <tr>
                                    <td>{{ $pCon->concepto }}</td>
                                    <td>{{ $pCon->total_pagos }}</td>
                                    <td><strong>${{ number_format($pCon->total_monto, 2) }}</strong></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" style="text-align: center; color: #888;">No hay pagos en el periodo.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </section>

        <div class="volver">

            <a href="/" class="boton boton-secundario">
                ← Volver al inicio
            </a>

        </div>

    </main>

</body>
</html>
