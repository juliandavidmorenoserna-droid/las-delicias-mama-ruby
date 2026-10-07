<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrar Pago - Las Delicias de Mamá Ruby</title>

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

            <h1>Registrar pago de nómina</h1>

            <p class="descripcion">
                Selecciona al empleado y especifica el monto y concepto del pago realizado.
            </p>

            <form action="{{ route('pagos.guardar') }}" method="POST">

                @csrf

                <div class="campo">
                    <label for="empleado_id">Empleado *</label>
                    <select id="empleado_id" name="empleado_id" required>
                        <option value="">-- Seleccionar empleado activo --</option>
                        @foreach($empleados as $emp)
                            <option
                                value="{{ $emp->id }}"
                                data-salario="{{ $emp->salario }}"
                                {{ old('empleado_id') == $emp->id ? 'selected' : '' }}
                            >
                                {{ $emp->nombre }} - {{ $emp->cargo }} (Salario base: ${{ number_format($emp->salario, 2) }})
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
                        value="{{ old('fecha', date('Y-m-d')) }}"
                        required
                    >
                    @error('fecha')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="concepto">Concepto de pago *</label>
                    <select id="concepto" name="concepto" required>
                        <option value="">Seleccione concepto</option>
                        <option value="Salario Quincenal" {{ old('concepto') == 'Salario Quincenal' ? 'selected' : '' }}>Salario Quincenal</option>
                        <option value="Salario Mensual Completo" {{ old('concepto') == 'Salario Mensual Completo' ? 'selected' : '' }}>Salario Mensual Completo</option>
                        <option value="Horas Extras" {{ old('concepto') == 'Horas Extras' ? 'selected' : '' }}>Horas Extras</option>
                        <option value="Bonificación / Propina" {{ old('concepto') == 'Bonificación / Propina' ? 'selected' : '' }}>Bonificación / Propina</option>
                        <option value="Adelanto de Salario" {{ old('concepto') == 'Adelanto de Salario' ? 'selected' : '' }}>Adelanto de Salario</option>
                        <option value="Liquidación" {{ old('concepto') == 'Liquidación' ? 'selected' : '' }}>Liquidación</option>
                        <option value="Otro" {{ old('concepto') == 'Otro' ? 'selected' : '' }}>Otro</option>
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
                        value="{{ old('monto') }}"
                        min="0.01"
                        step="0.01"
                        placeholder="Ejemplo: 700000"
                        required
                    >
                    @error('monto')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="metodo_pago">Método de pago *</label>
                    <select id="metodo_pago" name="metodo_pago" required>
                        <option value="Transferencia Bancaria" {{ old('metodo_pago') == 'Transferencia Bancaria' ? 'selected' : '' }}>Transferencia Bancaria</option>
                        <option value="Nequi / Daviplata" {{ old('metodo_pago') == 'Nequi / Daviplata' ? 'selected' : '' }}>Nequi / Daviplata</option>
                        <option value="Efectivo" {{ old('metodo_pago') == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
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
                        value="{{ old('comprobante') }}"
                        placeholder="Ej: TRANSF-98234 o Recibo #12"
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
                        placeholder="Comentarios adicionales del pago..."
                    >{{ old('notas') }}</textarea>
                    @error('notas')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="botones">
                    <a href="{{ route('pagos.index') }}" class="boton boton-secundario">
                        Cancelar
                    </a>

                    <button type="submit" class="boton">
                        Registrar pago
                    </button>
                </div>

            </form>

        </div>

    </main>

</body>
</html>
