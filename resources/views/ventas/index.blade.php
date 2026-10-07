<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ventas - Las Delicias de Mamá Ruby</title>

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
            width: 90%;
            max-width: 1100px;
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
        .filtros-contenedor {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .filtros-form {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }

        .filtros-form input {
            padding: 10px 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            flex: 1;
            min-width: 180px;
        }

        .btn-filtrar {
            background: #3b82c4;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-filtrar:hover {
            background: #2d6fa8;
        }

        .btn-limpiar {
            background: #e2e8f0;
            color: #4b2418;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
        }

        .mensaje {
            background: #d4edda;
            border: 1px solid #a3cfbb;
            color: #155724;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .mensaje-error {
            background: #f8d7da;
            border: 1px solid #f5c2c7;
            color: #842029;
        }

        .tabla-contenedor {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #3b82c4;
            color: white;
            padding: 15px;
            text-align: left;
            font-size: 15px;
        }

        td {
            padding: 14px 15px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        tr:hover {
            background: #fffaf2;
        }

        .codigo {
            font-weight: bold;
            color: #d63384;
        }

        .total {
            font-weight: bold;
            color: #2e7d32;
            font-size: 15px;
        }

        .metodo-badge {
            display: inline-block;
            padding: 4px 10px;
            background: #eef2f6;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            color: #244a73;
        }

        .acciones {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .btn-accion {
            display: inline-block;
            padding: 6px 11px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-ver {
            background: #3b82c4;
            color: white;
        }

        .btn-ver:hover {
            background: #285d8f;
        }

        .btn-eliminar {
            background: #c93b3b;
            color: white;
        }

        .btn-eliminar:hover {
            background: #a32828;
        }

        .sin-datos {
            text-align: center;
            padding: 35px;
            color: #777;
        }

        .volver {
            margin-top: 25px;
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
                <h1>Gestión de Ventas</h1>

                <p class="subtitulo">
                    Registro de comandas, facturación y control de ingresos
                </p>
            </div>

            <a href="{{ route('ventas.crear') }}" class="boton">
                + Registrar nueva venta
            </a>

        </div>

        @if(session('success'))
            <div class="mensaje">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mensaje mensaje-error">
                {{ session('error') }}
            </div>
        @endif

        <!-- BUSCADOR Y FILTROS -->
        <div class="filtros-contenedor">
            <form action="{{ route('ventas.index') }}" method="GET" class="filtros-form">

                <input
                    type="text"
                    name="buscar"
                    value="{{ $buscar }}"
                    placeholder="Buscar por código de venta o cliente..."
                >

                <input
                    type="date"
                    name="fecha"
                    value="{{ $fecha }}"
                    placeholder="Filtrar por fecha"
                >

                <button type="submit" class="btn-filtrar">
                    🔍 Filtrar
                </button>

                @if(!empty($buscar) || !empty($fecha))
                    <a href="{{ route('ventas.index') }}" class="btn-limpiar">
                        Limpiar filtros
                    </a>
                @endif

            </form>
        </div>

        <!-- TABLA DE VENTAS -->
        <div class="tabla-contenedor">

            <table>

                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Fecha y hora</th>
                        <th>Cliente / Mesa</th>
                        <th>Método de pago</th>
                        <th>Artículos</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($ventas as $vta)

                        <tr>

                            <td class="codigo">
                                {{ $vta->codigo }}
                            </td>

                            <td>
                                {{ $vta->fecha ? $vta->fecha->format('d/m/Y H:i') : 'N/A' }}
                            </td>

                            <td>
                                {{ $vta->cliente }}
                            </td>

                            <td>
                                <span class="metodo-badge">
                                    💳 {{ $vta->metodo_pago }}
                                </span>
                            </td>

                            <td>
                                {{ $vta->detalles->sum('cantidad') }} und
                            </td>

                            <td class="total">
                                ${{ number_format($vta->total, 2) }}
                            </td>

                            <td>
                                <div class="acciones">

                                    <a
                                        href="{{ route('ventas.ver', $vta) }}"
                                        class="btn-accion btn-ver"
                                        title="Ver comprobante de venta"
                                    >
                                        Ver comprobante
                                    </a>

                                    <form
                                        action="{{ route('ventas.eliminar', $vta) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Seguro que deseas anular esta venta? El stock se devolverá al inventario.');"
                                        style="display: inline;"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-accion btn-eliminar"
                                            title="Anular venta"
                                        >
                                            Anular
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="sin-datos">
                                No hay ventas registradas aún. ¡Haz clic en "+ Registrar nueva venta" para comenzar!
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="volver">

            <a href="/" class="boton boton-secundario">
                ← Volver al inicio
            </a>

        </div>

    </main>

</body>
</html>
