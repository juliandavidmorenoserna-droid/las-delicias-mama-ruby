<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detalle del producto - Las Delicias de Mamá Ruby</title>

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
            max-width: 700px;
            margin: 40px auto;
        }

        .tarjeta {
            background: white;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        h1 {
            text-align: center;
            color: #d63384;
            margin-bottom: 10px;
        }

        .descripcion {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
        }

        .detalle-lista {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 30px;
        }

        .detalle-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 16px;
            background: #fffaf2;
            border-radius: 8px;
            border: 1px solid #f2e2d2;
        }

        .detalle-etiqueta {
            font-weight: bold;
            color: #4b2418;
        }

        .detalle-valor {
            color: #244a73;
            font-weight: 500;
        }

        .estado {
            display: inline-block;
            padding: 6px 14px;
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

        .botones {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .boton {
            flex: 1;
            display: inline-block;
            text-align: center;
            background: #d63384;
            color: white;
            text-decoration: none;
            padding: 13px 20px;
            border-radius: 10px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            font-size: 15px;
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

        @media (max-width: 600px) {
            .tarjeta {
                padding: 25px;
            }

            .detalle-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .botones {
                flex-direction: column;
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

        <div class="tarjeta">

            <h1>Información del producto</h1>

            <p class="descripcion">
                Detalles registrados en el inventario del restaurante.
            </p>

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

            <div class="detalle-lista">

                <div class="detalle-item">
                    <span class="detalle-etiqueta">ID de registro:</span>
                    <span class="detalle-valor">#{{ $producto->id }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Nombre del producto:</span>
                    <span class="detalle-valor">{{ $producto->nombre }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Categoría:</span>
                    <span class="detalle-valor">{{ $producto->categoria }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Cantidad actual:</span>
                    <span class="detalle-valor">{{ $producto->cantidad }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Unidad de medida:</span>
                    <span class="detalle-valor">{{ $producto->unidad }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Stock mínimo permitido:</span>
                    <span class="detalle-valor">{{ $producto->stock_minimo }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Estado del inventario:</span>
                    <span class="estado {{ $claseEstado }}">{{ $estado }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Fecha de registro:</span>
                    <span class="detalle-valor">{{ $producto->created_at ? $producto->created_at->format('d/m/Y H:i') : 'N/A' }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Última actualización:</span>
                    <span class="detalle-valor">{{ $producto->updated_at ? $producto->updated_at->format('d/m/Y H:i') : 'N/A' }}</span>
                </div>

            </div>

            <div class="botones">

                <a
                    href="{{ route('inventario.index') }}"
                    class="boton boton-secundario"
                >
                    ← Volver al inventario
                </a>

                <a
                    href="{{ route('inventario.editar', $producto) }}"
                    class="boton"
                >
                    Editar producto
                </a>

            </div>

        </div>

    </main>

</body>
</html>
