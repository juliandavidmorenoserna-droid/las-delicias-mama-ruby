<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Productos del Restaurante - Las Delicias de Mamá Ruby</title>

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
            margin-bottom: 25px;
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

        /* BARRA DE FILTRO Y BÚSQUEDA */
        .filtros-contenedor {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .filtros-form {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }

        .filtros-form input,
        .filtros-form select {
            padding: 10px 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            flex: 1;
            min-width: 180px;
        }

        .btn-filtrar {
            background: #3b82c4;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-filtrar:hover {
            background: #2d6fa8;
        }

        .btn-limpiar {
            background: #e2e8f0;
            color: #4b2418;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            transition: 0.2s;
        }

        .btn-limpiar:hover {
            background: #cbd5e1;
        }

        .mensaje {
            background: #d4edda;
            border: 1px solid #a3cfbb;
            color: #155724;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 500;
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
            font-size: 15px;
        }

        td {
            padding: 14px 15px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        tr:hover {
            background: #fffaf2;
        }

        .precio {
            font-weight: bold;
            color: #2e7d32;
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

        .no-disponible {
            background: #f8d7da;
            color: #721c24;
        }

        .insumo-tag {
            display: inline-block;
            background: #e9ecef;
            color: #495057;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
        }

        .acciones {
            display: flex;
            gap: 6px;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn-accion {
            display: inline-block;
            padding: 6px 11px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-ver {
            background: #3b82c4;
            color: white;
        }

        .btn-ver:hover {
            background: #285d8f;
        }

        .btn-editar {
            background: #d4a017;
            color: white;
        }

        .btn-editar:hover {
            background: #b5870f;
        }

        .btn-eliminar {
            background: #c93b3b;
            color: white;
        }

        .btn-eliminar:hover {
            background: #a32828;
        }

        .sin-productos {
            text-align: center;
            padding: 35px;
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
                <h1>Productos del Restaurante</h1>

                <p class="subtitulo">
                    Catálogo de platos, bebidas y postres a la venta
                </p>
            </div>

            <a href="{{ route('productos.crear') }}" class="boton">
                + Registrar nuevo producto
            </a>

        </div>

        @if(session('success'))
            <div class="mensaje">
                {{ session('success') }}
            </div>
        @endif

        <!-- FILTROS Y BÚSQUEDA -->
        <div class="filtros-contenedor">
            <form action="{{ route('productos.index') }}" method="GET" class="filtros-form">

                <input
                    type="text"
                    name="buscar"
                    value="{{ $buscar }}"
                    placeholder="Buscar por nombre o descripción..."
                >

                <select name="categoria">
                    <option value="">Todas las categorías</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat }}" {{ $categoria == $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn-filtrar">
                    🔍 Filtrar
                </button>

                @if(!empty($buscar) || !empty($categoria))
                    <a href="{{ route('productos.index') }}" class="btn-limpiar">
                        Limpiar filtros
                    </a>
                @endif

            </form>
        </div>

        <!-- TABLA DE PRODUCTOS -->
        <div class="tabla-contenedor">

            <table>

                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Disponibilidad</th>
                        <th>Insumo vinculado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($productos as $item)

                        <tr>

                            <td>
                                <strong>{{ $item->nombre }}</strong>
                                @if($item->descripcion)
                                    <div style="font-size: 12px; color: #666; margin-top: 3px;">
                                        {{ Str::limit($item->descripcion, 50) }}
                                    </div>
                                @endif
                            </td>

                            <td>
                                {{ $item->categoria }}
                            </td>

                            <td class="precio">
                                ${{ number_format($item->precio, 2) }}
                            </td>

                            <td>
                                @if($item->disponible)
                                    <span class="estado disponible">Disponible</span>
                                @else
                                    <span class="estado no-disponible">No disponible</span>
                                @endif
                            </td>

                            <td>
                                @if($item->inventario)
                                    <span class="insumo-tag" title="Stock actual: {{ $item->inventario->cantidad }} {{ $item->inventario->unidad }}">
                                        📦 {{ $item->inventario->nombre }} ({{ $item->inventario->cantidad }} {{ $item->inventario->unidad }})
                                    </span>
                                @else
                                    <span style="color: #999; font-size: 13px;">Sin vincular</span>
                                @endif
                            </td>

                            <td>
                                <div class="acciones">

                                    <a
                                        href="{{ route('productos.ver', $item) }}"
                                        class="btn-accion btn-ver"
                                        title="Ver detalles"
                                    >
                                        Ver
                                    </a>

                                    <a
                                        href="{{ route('productos.editar', $item) }}"
                                        class="btn-accion btn-editar"
                                        title="Editar producto"
                                    >
                                        Editar
                                    </a>

                                    <form
                                        action="{{ route('productos.eliminar', $item) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto de la venta?');"
                                        style="display: inline;"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-accion btn-eliminar"
                                            title="Eliminar producto"
                                        >
                                            Eliminar
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="sin-productos">
                                No se encontraron productos registrados en el menú del restaurante.
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
