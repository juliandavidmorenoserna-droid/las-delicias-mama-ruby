<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Comprobante de Venta - {{ $venta->codigo }}</title>

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
            max-width: 650px;
            margin: 40px auto;
        }

        .factura-tarjeta {
            background: white;
            padding: 40px 30px;
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border-top: 6px solid #d63384;
        }

        .factura-cabecera {
            text-align: center;
            border-bottom: 2px dashed #f2c94c;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }

        .factura-cabecera h1 {
            color: #d63384;
            font-size: 26px;
            margin-bottom: 5px;
        }

        .factura-cabecera p {
            color: #666;
            font-size: 14px;
        }

        .factura-codigo {
            display: inline-block;
            background: #fff3cd;
            color: #856404;
            padding: 6px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 15px;
            margin-top: 10px;
        }

        .datos-venta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .dato-item strong {
            color: #244a73;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            background: #244a73;
            color: white;
            padding: 10px 12px;
            text-align: left;
            font-size: 13px;
        }

        td {
            padding: 10px 12px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .total-fila {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background: #f7e6ec;
            border-radius: 10px;
            margin-top: 15px;
            margin-bottom: 20px;
        }

        .total-etiqueta {
            font-size: 18px;
            font-weight: bold;
            color: #4b2418;
        }

        .total-monto {
            font-size: 24px;
            font-weight: bold;
            color: #d63384;
        }

        .notas-box {
            background: #fffaf2;
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            color: #666;
            border: 1px solid #ebd9c6;
            margin-bottom: 25px;
        }

        .botones {
            display: flex;
            gap: 15px;
        }

        .boton {
            flex: 1;
            display: inline-block;
            text-align: center;
            background: #d63384;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
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

        @media print {
            header, .botones {
                display: none;
            }
            body {
                background: white;
            }
            .factura-tarjeta {
                box-shadow: none;
                border-top: none;
                padding: 0;
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

        <div class="factura-tarjeta">

            <div class="factura-cabecera">
                <h1>Las Delicias de Mamá Ruby</h1>
                <p>Comprobante de Venta y Pago</p>
                <div class="factura-codigo">{{ $venta->codigo }}</div>
            </div>

            <div class="datos-venta">
                <div class="dato-item">
                    <strong>Fecha:</strong> {{ $venta->fecha ? $venta->fecha->format('d/m/Y H:i') : 'N/A' }}
                </div>
                <div class="dato-item">
                    <strong>Método de pago:</strong> {{ $venta->metodo_pago }}
                </div>
                <div class="dato-item">
                    <strong>Cliente / Mesa:</strong> {{ $venta->cliente }}
                </div>
                <div class="dato-item">
                    <strong>Total artículos:</strong> {{ $venta->detalles->sum('cantidad') }}
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Cant.</th>
                        <th>Precio unit.</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venta->detalles as $det)
                        <tr>
                            <td><strong>{{ $det->nombre_producto }}</strong></td>
                            <td>{{ $det->cantidad }}</td>
                            <td>${{ number_format($det->precio_unitario, 2) }}</td>
                            <td><strong>${{ number_format($det->subtotal, 2) }}</strong></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total-fila">
                <span class="total-etiqueta">TOTAL PAGADO:</span>
                <span class="total-monto">${{ number_format($venta->total, 2) }}</span>
            </div>

            @if($venta->notas)
                <div class="notas-box">
                    <strong>Notas:</strong> {{ $venta->notas }}
                </div>
            @endif

            <div class="botones">
                <a href="{{ route('ventas.index') }}" class="boton boton-secundario">
                    ← Volver a Ventas
                </a>

                <button onclick="window.print()" class="boton">
                    🖨️ Imprimir Comprobante
                </button>
            </div>

        </div>

    </main>

</body>
</html>
