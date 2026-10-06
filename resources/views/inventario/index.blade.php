<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inventario - Las Delicias de Mamá Ruby</title>

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
            margin-bottom: 30px;
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

        .mensaje {
            background: #d4edda;
            border: 1px solid #a3cfbb;
            color: #155724;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
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
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #fffaf2;
        }

        .estado {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .disponible {
            background: #d4edda;
            color: #155724;
        }

        .bajo {
            background: #fff3cd;
            color: #856404;
        }

        .agotado {
            background: #f8d7da;
            color: #721c24;
        }

        .sin-productos {
            text-align: center;
            padding: 30px;
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
                <h1>Gestión de inventario</h1>

                <p class="subtitulo">
                    Control de productos e insumos del restaurante
                </p>
            </div>

            <a href="/inventario/crear" class="boton">
                + Registrar producto
            </a>

        </div>

        @if(session('success'))
            <div class="mensaje">
                {{ session('success') }}
            </div>
        @endif

        <div class="tabla-contenedor">

            <table>

                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Cantidad</th>
                        <th>Unidad</th>
                        <th>Stock mínimo</th>
                        <th>Estado</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($productos as $producto)

                        @php
                            if ($producto->cantidad <= 0) {
                                $estado = 'Agotado';
                                $claseEstado = 'agotado';
                            } elseif ($producto->cantidad <= $producto->stock_minimo) {
                                $estado = 'Stock bajo';
                                $claseEstado = 'bajo';
                            } else {
                                $estado = 'Disponible';
                                $claseEstado = 'disponible';
                            }
                        @endphp

                        <tr>

                            <td>
                                {{ $producto->nombre }}
                            </td>

                            <td>
                                {{ $producto->categoria }}
                            </td>

                            <td>
                                {{ $producto->cantidad }}
                            </td>

                            <td>
                                {{ $producto->unidad }}
                            </td>

                            <td>
                                {{ $producto->stock_minimo }}
                            </td>

                            <td>
                                <span class="estado {{ $claseEstado }}">
                                    {{ $estado }}
                                </span>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="sin-productos">
                                No hay productos registrados en el inventario.
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