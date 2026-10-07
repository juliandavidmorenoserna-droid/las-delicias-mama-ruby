<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Recibo de Pago - Las Delicias de Mamá Ruby</title>

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

        .recibo-tarjeta {
            background: white;
            padding: 40px 30px;
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border-top: 6px solid #3b82c4;
        }

        .recibo-cabecera {
            text-align: center;
            border-bottom: 2px dashed #f2c94c;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }

        .recibo-cabecera h1 {
            color: #d63384;
            font-size: 26px;
            margin-bottom: 5px;
        }

        .recibo-cabecera p {
            color: #666;
            font-size: 14px;
        }

        .recibo-codigo {
            display: inline-block;
            background: #e1effe;
            color: #1e429f;
            padding: 6px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 15px;
            margin-top: 10px;
        }

        .detalle-lista {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-bottom: 25px;
        }

        .detalle-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 16px;
            background: #fffaf2;
            border-radius: 8px;
            border: 1px solid #ebd9c6;
            font-size: 14px;
        }

        .detalle-etiqueta {
            font-weight: bold;
            color: #4b2418;
        }

        .detalle-valor {
            color: #244a73;
            font-weight: 500;
        }

        .monto-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 20px;
            background: #f7e6ec;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .monto-etiqueta {
            font-size: 18px;
            font-weight: bold;
            color: #4b2418;
        }

        .monto-valor {
            font-size: 26px;
            font-weight: bold;
            color: #2e7d32;
        }

        .firmas-box {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-top: 40px;
            margin-bottom: 30px;
            text-align: center;
        }

        .linea-firma {
            border-top: 1px solid #999;
            padding-top: 8px;
            font-size: 13px;
            color: #555;
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
            .recibo-tarjeta {
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

        <div class="recibo-tarjeta">

            <div class="recibo-cabecera">
                <h1>Las Delicias de Mamá Ruby</h1>
                <p>Comprobante de Pago de Nómina</p>
                <div class="recibo-codigo">RECIBO DE PAGO #{{ $pago->id }}</div>
            </div>

            <div class="detalle-lista">

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Colaborador / Empleado:</span>
                    <span class="detalle-valor">{{ $pago->empleado ? $pago->empleado->nombre : 'N/A' }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Documento de identidad:</span>
                    <span class="detalle-valor">{{ $pago->empleado ? $pago->empleado->documento : 'N/A' }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Cargo desempeñado:</span>
                    <span class="detalle-valor">{{ $pago->empleado ? $pago->empleado->cargo : 'N/A' }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Fecha del desembolso:</span>
                    <span class="detalle-valor">{{ $pago->fecha ? $pago->fecha->format('d/m/Y') : 'N/A' }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Concepto del pago:</span>
                    <span class="detalle-valor">{{ $pago->concepto }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Método de pago:</span>
                    <span class="detalle-valor">{{ $pago->metodo_pago }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Referencia / Comprobante:</span>
                    <span class="detalle-valor">{{ $pago->comprobante ?: 'No especificado' }}</span>
                </div>

                @if($pago->notas)
                    <div class="detalle-item">
                        <span class="detalle-etiqueta">Observaciones:</span>
                        <span class="detalle-valor">{{ $pago->notas }}</span>
                    </div>
                @endif

            </div>

            <div class="monto-box">
                <span class="monto-etiqueta">MONTO PAGADO:</span>
                <span class="monto-valor">${{ number_format($pago->monto, 2) }}</span>
            </div>

            <div class="firmas-box">
                <div class="linea-firma">
                    Firma del Empleador / Pagador
                </div>
                <div class="linea-firma">
                    Firma de Recibido (Empleado)
                </div>
            </div>

            <div class="botones">
                <a href="{{ route('pagos.index') }}" class="boton boton-secundario">
                    ← Volver a Pagos
                </a>

                <button onclick="window.print()" class="boton">
                    🖨️ Imprimir Recibo
                </button>
            </div>

        </div>

    </main>

</body>
</html>
