<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - Las Delicias de Mamá Ruby</title>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, sans-serif;
            background: #fff8f2;
            color: #4b2418;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── BARRA TOP ──────────────────────────────────────── */
        .barra-top {
            background: #244a73;
            color: white;
            padding: 10px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
        }

        .barra-top a { color: #f2c94c; text-decoration: none; font-weight: bold; }
        .barra-top a:hover { text-decoration: underline; }

        .btn-logout {
            background: #c93b3b; color: white; border: none;
            padding: 6px 14px; border-radius: 20px; cursor: pointer;
            font-size: 13px; font-weight: bold; transition: 0.2s;
        }
        .btn-logout:hover { background: #a32828; }

        /* ── HEADER ─────────────────────────────────────────── */
        header {
            background: linear-gradient(135deg, #f7b6d2, #f48fb1);
            padding: 18px 25px;
            border-bottom: 5px solid #d4a017;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        header img {
            width: 65px; height: 65px; border-radius: 50%;
            object-fit: contain; background: white; padding: 5px;
        }

        header h1 { font-size: 22px; color: #4a2c2a; }
        header p  { font-size: 13px; color: #244a73; margin-top: 3px; }

        /* ── MAIN ───────────────────────────────────────────── */
        main {
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px;
            flex: 1;
            width: 100%;
        }

        /* ── ALERTAS ────────────────────────────────────────── */
        .alerta {
            padding: 14px 20px; border-radius: 10px;
            margin-bottom: 20px; font-weight: bold; text-align: center;
        }

        .alerta-exito {
            background: #d4edda; color: #155724; border: 1px solid #c3e6cb;
        }

        .alerta-error {
            background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;
        }

        /* ── BARRA ACCIONES ─────────────────────────────────── */
        .barra-acciones {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .barra-acciones h2 {
            font-size: 22px;
            color: #4a2c2a;
        }

        .btn-nuevo {
            background: #d14d72; color: white;
            padding: 10px 22px; border-radius: 25px;
            text-decoration: none; font-weight: bold;
            font-size: 14px; transition: 0.2s; display: inline-block;
        }

        .btn-nuevo:hover { background: #244a73; transform: scale(1.04); }

        /* ── CONTADOR ADMINS ────────────────────────────────── */
        .contador-admins {
            background: white;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 22px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .contador-icono { font-size: 32px; }

        .contador-texto h3 {
            font-size: 15px;
            color: #4a2c2a;
            margin-bottom: 4px;
        }

        .barra-progreso-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .barra-progreso {
            width: 180px;
            height: 10px;
            background: #f0f0f0;
            border-radius: 5px;
            overflow: hidden;
        }

        .barra-progreso-fill {
            height: 100%;
            border-radius: 5px;
            transition: width 0.4s;
        }

        .fill-normal  { background: #28a745; }
        .fill-lleno   { background: #dc3545; }

        .progreso-texto {
            font-size: 13px;
            font-weight: bold;
            color: #555;
        }

        /* ── TABLA ──────────────────────────────────────────── */
        .tabla-wrap {
            background: white;
            border-radius: 15px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead { background: #244a73; color: white; }

        thead th {
            padding: 14px 16px;
            text-align: left;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody tr { border-bottom: 1px solid #f5f5f5; transition: 0.15s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #fffaf2; }

        tbody td {
            padding: 14px 16px;
            font-size: 14px;
            vertical-align: middle;
        }

        /* ── BADGES DE ROL ──────────────────────────────────── */
        .badge-rol {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-admin    { background: #fce8f1; color: #c0256b; }
        .badge-empleado { background: #e8f0fe; color: #1a56c4; }
        .badge-cliente  { background: #e8fce8; color: #1a8a1a; }

        /* ── BOTÓN ELIMINAR ─────────────────────────────────── */
        .btn-eliminar {
            background: #f8d7da; color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 5px 12px; border-radius: 6px;
            font-size: 12px; cursor: pointer; font-weight: bold;
            transition: 0.2s;
        }

        .btn-eliminar:hover { background: #dc3545; color: white; }

        .btn-yo {
            font-size: 12px; color: #aaa;
            font-style: italic; padding: 5px 0;
        }

        /* ── VOLVER ─────────────────────────────────────────── */
        .volver {
            margin-top: 25px;
            text-align: center;
        }

        .volver a {
            color: #244a73; text-decoration: none; font-size: 14px;
        }

        .volver a:hover { text-decoration: underline; }

        footer {
            background: #244a73; color: white;
            text-align: center; padding: 18px;
            margin-top: 40px; font-size: 13px;
        }

        @media (max-width: 600px) {
            .barra-acciones { flex-direction: column; }
            thead { display: none; }
            tbody tr {
                display: block;
                padding: 12px;
                border: 1px solid #eee;
                margin-bottom: 10px;
                border-radius: 10px;
            }
            tbody td { display: block; padding: 4px 0; border: none; }
        }
    </style>
</head>

<body>

    {{-- BARRA TOP --}}
    <div class="barra-top">
        <span><a href="{{ route('inicio') }}">← Panel Admin</a></span>
        <div style="display:flex; align-items:center; gap:12px;">
            <span>🛡️ <strong>{{ Auth::user()->name }}</strong></span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">Cerrar Sesión</button>
            </form>
        </div>
    </div>

    {{-- HEADER --}}
    <header>
        <img src="{{ asset('imagenes/logo.png') }}" alt="Logo">
        <div>
            <h1>👥 Gestión de Usuarios</h1>
            <p>Administra quién tiene acceso al sistema del restaurante</p>
        </div>
    </header>

    <main>

        {{-- ALERTAS --}}
        @if(session('success'))
            <div class="alerta alerta-exito">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alerta alerta-error">{{ session('error') }}</div>
        @endif

        {{-- BARRA DE ACCIONES --}}
        <div class="barra-acciones">
            <h2>Usuarios del Sistema</h2>
            <a href="{{ route('usuarios.crear') }}" class="btn-nuevo">+ Agregar Usuario</a>
        </div>

        {{-- CONTADOR DE ADMINISTRADORES --}}
        <div class="contador-admins">
            <div class="contador-icono">🛡️</div>
            <div class="contador-texto">
                <h3>Administradores registrados: {{ $totalAdmins }} de 2 permitidos</h3>
                <div class="barra-progreso-wrap">
                    <div class="barra-progreso">
                        <div
                            class="barra-progreso-fill {{ $totalAdmins >= 2 ? 'fill-lleno' : 'fill-normal' }}"
                            style="width: {{ ($totalAdmins / 2) * 100 }}%"
                        ></div>
                    </div>
                    <span class="progreso-texto">
                        @if($totalAdmins >= 2)
                            ⚠️ Límite alcanzado — no se pueden agregar más administradores
                        @else
                            {{ 2 - $totalAdmins }} cupo(s) disponible(s) para administrador
                        @endif
                    </span>
                </div>
            </div>
        </div>

        {{-- TABLA DE USUARIOS --}}
        <div class="tabla-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $index => $usuario)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $usuario->name }}</strong></td>
                            <td>{{ $usuario->email }}</td>
                            <td>
                                @if($usuario->rol === 'admin')
                                    <span class="badge-rol badge-admin">🛡️ Administrador</span>
                                @elseif($usuario->rol === 'empleado')
                                    <span class="badge-rol badge-empleado">🧑‍🍳 Empleado</span>
                                @else
                                    <span class="badge-rol badge-cliente">🍽️ Cliente</span>
                                @endif
                            </td>
                            <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if($usuario->id === Auth::user()->id)
                                    <span class="btn-yo">👤 Tú mismo</span>
                                @else
                                    <form
                                        action="{{ route('usuarios.eliminar', $usuario->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Eliminar a {{ $usuario->name }}? Esta acción no se puede deshacer.')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-eliminar">🗑️ Eliminar</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="volver">
            <a href="{{ route('inicio') }}">← Volver al panel principal</a>
        </div>

    </main>

    <footer>
        <p>Las Delicias de Mamá Ruby © 2026</p>
    </footer>

</body>
</html>
