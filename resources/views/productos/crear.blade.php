<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrar Producto de Venta - Las Delicias de Mamá Ruby</title>

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

        .ayuda {
            font-size: 13px;
            color: #666;
            margin-top: 4px;
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

            <h1>Registrar producto para la venta</h1>

            <p class="descripcion">
                Agrega un nuevo plato, bebida o postre a la carta del restaurante.
            </p>

            <form action="{{ route('productos.guardar') }}" method="POST">

                @csrf

                <div class="campo">
                    <label for="nombre">Nombre del producto *</label>
                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        value="{{ old('nombre') }}"
                        placeholder="Ejemplo: Bandeja Paisa Especial"
                        required
                    >
                    @error('nombre')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="categoria">Categoría del plato o producto *</label>
                    <input
                        type="text"
                        id="categoria"
                        name="categoria"
                        list="categorias-sugeridas"
                        value="{{ old('categoria') }}"
                        placeholder="Ejemplo: Platos Fuertes, Bebidas, Bandejas, Postres..."
                        required
                    >
                    <datalist id="categorias-sugeridas">
                        <option value="Platos Fuertes">
                        <option value="Bandejas">
                        <option value="Sopas">
                        <option value="Almuerzos">
                        <option value="Desayunos">
                        <option value="Bebidas">
                        <option value="Entradas">
                        <option value="Postres">
                        <option value="Comidas Rápidas">
                    </datalist>
                    <div class="ayuda">Puedes seleccionar una sugerencia o escribir la categoría que tú quieras.</div>
                    @error('categoria')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="precio">Precio de venta ($) *</label>
                    <input
                        type="number"
                        id="precio"
                        name="precio"
                        value="{{ old('precio') }}"
                        min="0"
                        step="0.01"
                        placeholder="Ejemplo: 18000"
                        required
                    >
                    @error('precio')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="descripcion">Descripción del producto</label>
                    <textarea
                        id="descripcion"
                        name="descripcion"
                        rows="3"
                        placeholder="Detalla los ingredientes o características del plato..."
                    >{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="disponible">Disponibilidad en la carta *</label>
                    <select id="disponible" name="disponible" required>
                        <option value="1" {{ old('disponible', '1') == '1' ? 'selected' : '' }}>Disponible para la venta</option>
                        <option value="0" {{ old('disponible') === '0' ? 'selected' : '' }}>No disponible temporalmente</option>
                    </select>
                    @error('disponible')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="producto_id">Vincular con insumo del inventario (Opcional)</label>
                    <select id="producto_id" name="producto_id">
                        <option value="">Ninguno (plato sin control directo de un único insumo)</option>
                        @foreach($insumosInventario as $insumo)
                            <option value="{{ $insumo->id }}" {{ old('producto_id') == $insumo->id ? 'selected' : '' }}>
                                {{ $insumo->nombre }} (Stock: {{ $insumo->cantidad }} {{ $insumo->unidad }})
                            </option>
                        @endforeach
                    </select>
                    <p class="ayuda">Al vincular un insumo, cada venta podrá descontar automáticamente su stock del inventario.</p>
                    @error('producto_id')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="botones">
                    <a href="{{ route('productos.index') }}" class="boton boton-secundario">
                        Cancelar
                    </a>

                    <button type="submit" class="boton">
                        Guardar producto
                    </button>
                </div>

            </form>

        </div>

    </main>

</body>
</html>
