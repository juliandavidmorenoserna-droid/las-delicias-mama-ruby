<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrar producto - Las Delicias de Mamá Ruby</title>

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

            <h1>Registrar producto</h1>

            <p class="descripcion">
                Agrega un nuevo producto al inventario del restaurante.
            </p>

            <form action="/inventario" method="POST">

                @csrf

                <div class="campo">
                    <label for="nombre">
                        Nombre del producto
                    </label>

                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        value="{{ old('nombre') }}"
                        placeholder="Ejemplo: Arroz"
                        required
                    >

                    @error('nombre')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="categoria">
                        Categoría
                    </label>

                    <select
                        id="categoria"
                        name="categoria"
                        required
                    >
                        <option value="">
                            Seleccione una categoría
                        </option>

                        <option value="Alimentos"
                            {{ old('categoria') == 'Alimentos' ? 'selected' : '' }}>
                            Alimentos
                        </option>

                        <option value="Bebidas"
                            {{ old('categoria') == 'Bebidas' ? 'selected' : '' }}>
                            Bebidas
                        </option>

                        <option value="Aseo"
                            {{ old('categoria') == 'Aseo' ? 'selected' : '' }}>
                            Aseo
                        </option>

                        <option value="Otros"
                            {{ old('categoria') == 'Otros' ? 'selected' : '' }}>
                            Otros
                        </option>
                    </select>

                    @error('categoria')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="cantidad">
                        Cantidad
                    </label>

                    <input
                        type="number"
                        id="cantidad"
                        name="cantidad"
                        value="{{ old('cantidad') }}"
                        min="0"
                        step="0.01"
                        placeholder="Ejemplo: 20"
                        required
                    >

                    @error('cantidad')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="unidad">
                        Unidad de medida
                    </label>

                    <select
                        id="unidad"
                        name="unidad"
                        required
                    >
                        <option value="">
                            Seleccione una unidad
                        </option>

                        <option value="Unidades"
                            {{ old('unidad') == 'Unidades' ? 'selected' : '' }}>
                            Unidades
                        </option>

                        <option value="Kg"
                            {{ old('unidad') == 'Kg' ? 'selected' : '' }}>
                            Kilogramos (Kg)
                        </option>

                        <option value="Gramos"
                            {{ old('unidad') == 'Gramos' ? 'selected' : '' }}>
                            Gramos
                        </option>

                        <option value="Litros"
                            {{ old('unidad') == 'Litros' ? 'selected' : '' }}>
                            Litros
                        </option>

                        <option value="Mililitros"
                            {{ old('unidad') == 'Mililitros' ? 'selected' : '' }}>
                            Mililitros
                        </option>
                    </select>

                    @error('unidad')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="stock_minimo">
                        Stock mínimo
                    </label>

                    <input
                        type="number"
                        id="stock_minimo"
                        name="stock_minimo"
                        value="{{ old('stock_minimo') }}"
                        min="0"
                        step="0.01"
                        placeholder="Ejemplo: 5"
                        required
                    >

                    @error('stock_minimo')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="botones">

                    <a
                        href="/inventario"
                        class="boton boton-secundario"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="boton"
                    >
                        Guardar producto
                    </button>

                </div>

            </form>

        </div>

    </main>

</body>
</html>