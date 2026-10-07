<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrar Empleado - Las Delicias de Mamá Ruby</title>

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
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            background: white;
        }

        input:focus,
        select:focus {
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

            <h1>Registrar nuevo empleado</h1>

            <p class="descripcion">
                Ingresa los datos personales y laborales del colaborador.
            </p>

            <form action="{{ route('empleados.guardar') }}" method="POST">

                @csrf

                <div class="campo">
                    <label for="nombre">Nombre completo *</label>
                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        value="{{ old('nombre') }}"
                        placeholder="Ejemplo: María Rodríguez"
                        required
                    >
                    @error('nombre')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="documento">Documento de identidad *</label>
                    <input
                        type="text"
                        id="documento"
                        name="documento"
                        value="{{ old('documento') }}"
                        placeholder="Ejemplo: 1020304050"
                        required
                    >
                    @error('documento')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="telefono">Número de teléfono</label>
                    <input
                        type="text"
                        id="telefono"
                        name="telefono"
                        value="{{ old('telefono') }}"
                        placeholder="Ejemplo: 3101234567"
                    >
                    @error('telefono')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="cargo">Cargo / Puesto *</label>
                    <select id="cargo" name="cargo" required>
                        <option value="">Seleccione un cargo</option>
                        <option value="Chef Principal" {{ old('cargo') == 'Chef Principal' ? 'selected' : '' }}>Chef Principal</option>
                        <option value="Cocinero" {{ old('cargo') == 'Cocinero' ? 'selected' : '' }}>Cocinero</option>
                        <option value="Auxiliar de Cocina" {{ old('cargo') == 'Auxiliar de Cocina' ? 'selected' : '' }}>Auxiliar de Cocina</option>
                        <option value="Mesero" {{ old('cargo') == 'Mesero' ? 'selected' : '' }}>Mesero</option>
                        <option value="Cajero" {{ old('cargo') == 'Cajero' ? 'selected' : '' }}>Cajero</option>
                        <option value="Administrador" {{ old('cargo') == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                        <option value="Personal de Limpieza" {{ old('cargo') == 'Personal de Limpieza' ? 'selected' : '' }}>Personal de Limpieza</option>
                    </select>
                    @error('cargo')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="salario">Salario mensual ($) *</label>
                    <input
                        type="number"
                        id="salario"
                        name="salario"
                        value="{{ old('salario') }}"
                        min="0"
                        step="0.01"
                        placeholder="Ejemplo: 1400000"
                        required
                    >
                    @error('salario')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="fecha_ingreso">Fecha de ingreso *</label>
                    <input
                        type="date"
                        id="fecha_ingreso"
                        name="fecha_ingreso"
                        value="{{ old('fecha_ingreso', date('Y-m-d')) }}"
                        required
                    >
                    @error('fecha_ingreso')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="estado">Estado laboral *</label>
                    <select id="estado" name="estado" required>
                        <option value="Activo" {{ old('estado', 'Activo') == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="botones">
                    <a href="{{ route('empleados.index') }}" class="boton boton-secundario">
                        Cancelar
                    </a>

                    <button type="submit" class="boton">
                        Guardar empleado
                    </button>
                </div>

            </form>

        </div>

    </main>

</body>
</html>
