<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Empleados - Las Delicias de Mamá Ruby</title>

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

        /* FILTROS */
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

        .estado {
            display: inline-block;
            padding: 6px 12px;
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
            font-weight: bold;
            color: #2e7d32;
        }

        .acciones {
            display: flex;
            gap: 6px;
            align-items: center;
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

        .sin-datos {
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
                <h1>Gestión de Empleados</h1>

                <p class="subtitulo">
                    Personal del restaurante, cargos y salarios
                </p>
            </div>

            <a href="{{ route('empleados.crear') }}" class="boton">
                + Registrar nuevo empleado
            </a>

        </div>

        @if(session('success'))
            <div class="mensaje">
                {{ session('success') }}
            </div>
        @endif

        <!-- FILTROS -->
        <div class="filtros-contenedor">
            <form action="{{ route('empleados.index') }}" method="GET" class="filtros-form">

                <input
                    type="text"
                    name="buscar"
                    value="{{ $buscar }}"
                    placeholder="Buscar por nombre, documento o cargo..."
                >

                <select name="estado">
                    <option value="">Todos los estados</option>
                    <option value="Activo" {{ $estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ $estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>

                <button type="submit" class="btn-filtrar">
                    🔍 Filtrar
                </button>

                @if(!empty($buscar) || !empty($estado))
                    <a href="{{ route('empleados.index') }}" class="btn-limpiar">
                        Limpiar filtros
                    </a>
                @endif

            </form>
        </div>

        <!-- TABLA -->
        <div class="tabla-contenedor">

            <table>

                <thead>
                    <tr>
                        <th>Documento</th>
                        <th>Nombre</th>
                        <th>Cargo</th>
                        <th>Teléfono</th>
                        <th>Salario</th>
                        <th>Ingreso</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($empleados as $emp)

                        <tr>

                            <td>
                                <strong>{{ $emp->documento }}</strong>
                            </td>

                            <td>
                                {{ $emp->nombre }}
                            </td>

                            <td>
                                {{ $emp->cargo }}
                            </td>

                            <td>
                                {{ $emp->telefono ?: 'N/A' }}
                            </td>

                            <td class="salario">
                                ${{ number_format($emp->salario, 2) }}
                            </td>

                            <td>
                                {{ $emp->fecha_ingreso ? $emp->fecha_ingreso->format('d/m/Y') : 'N/A' }}
                            </td>

                            <td>
                                <span class="estado {{ strtolower($emp->estado) }}">
                                    {{ $emp->estado }}
                                </span>
                            </td>

                            <td>
                                <div class="acciones">

                                    <a
                                        href="{{ route('empleados.ver', $emp) }}"
                                        class="btn-accion btn-ver"
                                        title="Ver perfil"
                                    >
                                        Ver
                                    </a>

                                    <a
                                        href="{{ route('empleados.editar', $emp) }}"
                                        class="btn-accion btn-editar"
                                        title="Editar empleado"
                                    >
                                        Editar
                                    </a>

                                    <form
                                        action="{{ route('empleados.eliminar', $emp) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar a {{ $emp->nombre }} del sistema?');"
                                        style="display: inline;"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-accion btn-eliminar"
                                            title="Eliminar empleado"
                                        >
                                            Eliminar
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="sin-datos">
                                No hay empleados registrados en el sistema.
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
