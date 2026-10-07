<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Pago - Las Delicias de Mamá Ruby</title>

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

        .campo {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #4b2418;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            background: white;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #d63384;
        }

        .error {
            color: #b42318;
            font-size: 14px;
            margin-top: 5px;
        }

        .botones {
            display: flex;
            gap: 15px;
            margin-top: 30px;
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

            <h1>Editar registro de pago</h1>

            <p class="descripcion">
                Modifica los datos del pago al colaborador.
            </p>

            <form action="{{ route('pagos.actualizar', $pago) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="campo">
                    <label for="empleado_id">Empleado *</label>
                    @php
                        $empleadoActual = old('empleado_id', $pago->empleado_id);
                    @endphp
                    <select id="empleado_id" name="empleado_id" required>
                        <option value="">-- Seleccionar empleado --</option>
                        @foreach($empleados as $emp)
                            <option
                                value="{{ $emp->id }}"
                                {{ $empleadoActual == $emp->id ? 'selected' : '' }}
                            >
                                {{ $emp->nombre }} - {{ $emp->cargo }}
                            </option>
                        @endforeach
                    </select>
                    @error('empleado_id')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="fecha">Fecha de pago *</label>
                    <input
                        type="date"
                        id="fecha"
                        name="fecha"
                        value="{{ old('fecha', $pago->fecha ? $pago->fecha->format('Y-m-d') : '') }}"
                        required
                    >
                    @error('fecha')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="concepto">Concepto de pago *</label>
                    @php
                        $conceptoActual = old('concepto', $pago->concepto);
                    @endphp
                    <select id="concepto" name="concepto" required>
                        <option value="">Seleccione concepto</option>
                        <option value="Salario Quincenal" {{ $conceptoActual == 'Salario Quincenal' ? 'selected' : '' }}>Salario Quincenal</option>
                        <option value="Salario Mensual Completo" {{ $conceptoActual == 'Salario Mensual Completo' ? 'selected' : '' }}>Salario Mensual Completo</option>
                        <option value="Horas Extras" {{ $conceptoActual == 'Horas Extras' ? 'selected' : '' }}>Horas Extras</option>
                        <option value="Bonificación / Propina" {{ $conceptoActual == 'Bonificación / Propina' ? 'selected' : '' }}>Bonificación / Propina</option>
                        <option value="Adelanto de Salario" {{ $conceptoActual == 'Adelanto de Salario' ? 'selected' : '' }}>Adelanto de Salario</option>
                        <option value="Liquidación" {{ $conceptoActual == 'Liquidación' ? 'selected' : '' }}>Liquidación</option>
                        <option value="Otro" {{ $conceptoActual == 'Otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('concepto')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="monto">Monto a pagar ($) *</label>
                    <input
                        type="number"
                        id="monto"
                        name="monto"
                        value="{{ old('monto', $pago->monto) }}"
                        min="0.01"
                        step="0.01"
                        required
                    >
                    @error('monto')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="metodo_pago">Método de pago *</label>
                    @php
                        $metodoActual = old('metodo_pago', $pago->metodo_pago);
                    @endphp
                    <select id="metodo_pago" name="metodo_pago" required>
                        <option value="Transferencia Bancaria" {{ $metodoActual == 'Transferencia Bancaria' ? 'selected' : '' }}>Transferencia Bancaria</option>
                        <option value="Nequi / Daviplata" {{ $metodoActual == 'Nequi / Daviplata' ? 'selected' : '' }}>Nequi / Daviplata</option>
                        <option value="Efectivo" {{ $metodoActual == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                    </select>
                    @error('metodo_pago')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="comprobante">Número de referencia / Comprobante (opcional)</label>
                    <input
                        type="text"
                        id="comprobante"
                        name="comprobante"
                        value="{{ old('comprobante', $pago->comprobante) }}"
                    >
                    @error('comprobante')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="notas">Observaciones o notas</label>
                    <textarea
                        id="notas"
                        name="notas"
                        rows="2"
                    >{{ old('notas', $pago->notas) }}</textarea>
                    @error('notas')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="botones">
                    <a href="{{ route('pagos.index') }}" class="boton boton-secundario">
                        Cancelar
                    </a>

                    <button type="submit" class="boton">
                        Guardar cambios
                    </button>
                </div>

            </form>

        </div>

    </main>

</body>
</html>
