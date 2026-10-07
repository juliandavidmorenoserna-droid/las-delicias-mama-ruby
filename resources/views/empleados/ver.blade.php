<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Perfil de Empleado - {{ $empleado->nombre }}</title>

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

        .activo {
            background: #d4edda;
            color: #155724;
        }

        .inactivo {
            background: #e2e8f0;
            color: #475569;
        }

        .salario {
            font-size: 18px;
            font-weight: bold;
            color: #2e7d32;
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

            <h1>Ficha del Colaborador</h1>

            <p class="descripcion">
                Información del empleado registrado en el restaurante.
            </p>

            <div class="detalle-lista">

                <div class="detalle-item">
                    <span class="detalle-etiqueta">ID de registro:</span>
                    <span class="detalle-valor">#{{ $empleado->id }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Nombre completo:</span>
                    <span class="detalle-valor">{{ $empleado->nombre }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Documento de identidad:</span>
                    <span class="detalle-valor">{{ $empleado->documento }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Teléfono:</span>
                    <span class="detalle-valor">{{ $empleado->telefono ?: 'No registrado' }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Cargo / Puesto:</span>
                    <span class="detalle-valor">{{ $empleado->cargo }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Salario mensual:</span>
                    <span class="salario">${{ number_format($empleado->salario, 2) }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Fecha de ingreso:</span>
                    <span class="detalle-valor">{{ $empleado->fecha_ingreso ? $empleado->fecha_ingreso->format('d/m/Y') : 'N/A' }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Estado actual:</span>
                    <span class="estado {{ strtolower($empleado->estado) }}">{{ $empleado->estado }}</span>
                </div>

                <div class="detalle-item">
                    <span class="detalle-etiqueta">Fecha de registro:</span>
                    <span class="detalle-valor">{{ $empleado->created_at ? $empleado->created_at->format('d/m/Y H:i') : 'N/A' }}</span>
                </div>

            </div>

            <div class="botones">

                <a
                    href="{{ route('empleados.index') }}"
                    class="boton boton-secundario"
                >
                    ← Volver a empleados
                </a>

                <a
                    href="{{ route('empleados.editar', $empleado) }}"
                    class="boton"
                >
                    Editar empleado
                </a>

            </div>

        </div>

    </main>

</body>
</html>
