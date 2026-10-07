<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Usuario - Las Delicias de Mamá Ruby</title>

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

        header {
            background: linear-gradient(135deg, #f7b6d2, #f48fb1);
            padding: 18px 25px;
            border-bottom: 5px solid #d4a017;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        header img {
            width: 60px; height: 60px; border-radius: 50%;
            object-fit: contain; background: white; padding: 5px;
        }

        header h1 { font-size: 22px; color: #4a2c2a; }
        header p  { font-size: 13px; color: #244a73; margin-top: 3px; }

        main {
            max-width: 650px;
            margin: 30px auto;
            padding: 0 20px;
            flex: 1;
            width: 100%;
        }

        .card-formulario {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .card-formulario h2 {
            font-size: 20px;
            color: #4a2c2a;
            margin-bottom: 8px;
        }

        .card-formulario p.subtitulo {
            font-size: 13px;
            color: #666;
            margin-bottom: 22px;
        }

        .alerta-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .alerta-error ul {
            margin-left: 20px;
            margin-top: 5px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            color: #4a2c2a;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid #d1b8b0;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }

        input:focus {
            border-color: #d14d72;
            box-shadow: 0 0 0 3px rgba(209, 77, 114, 0.15);
        }

        /* ── SELECCIÓN DE ROL ───────────────────────────────── */
        .roles-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 6px;
        }

        .rol-opcion {
            position: relative;
        }

        .rol-opcion input[type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .rol-box {
            border: 2px solid #e0d0cb;
            border-radius: 12px;
            padding: 14px;
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            background: #fffdfc;
        }

        .rol-box .icono { font-size: 26px; }
        .rol-box .titulo { font-weight: bold; font-size: 14px; color: #4a2c2a; }
        .rol-box .desc { font-size: 11px; color: #777; line-height: 1.3; }

        .rol-opcion input[type="radio"]:checked + .rol-box {
            border-color: #d14d72;
            background: #fff3f6;
            box-shadow: 0 0 0 2px #d14d72;
        }

        .rol-deshabilitado .rol-box {
            background: #f5f5f5;
            border-color: #ddd;
            opacity: 0.6;
            cursor: not-allowed;
        }

        .aviso-limite {
            display: inline-block;
            background: #ffebcc;
            color: #a85800;
            font-size: 11px;
            font-weight: bold;
            padding: 2px 8px;
            border-radius: 10px;
            margin-top: 4px;
        }

        .btn-guardar {
            background: #d14d72;
            color: white;
            border: none;
            width: 100%;
            padding: 13px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 10px;
        }

        .btn-guardar:hover {
            background: #244a73;
        }

        .volver {
            text-align: center;
            margin-top: 20px;
        }

        .volver a {
            color: #244a73;
            text-decoration: none;
            font-size: 13px;
        }

        .volver a:hover { text-decoration: underline; }

        footer {
            background: #244a73;
            color: white;
            text-align: center;
            padding: 16px;
            font-size: 13px;
            margin-top: 40px;
        }
    </style>
</head>
<body>

    <div class="barra-top">
        <span><a href="{{ route('usuarios.index') }}">← Volver a Usuarios</a></span>
        <span>Panel Administrador</span>
    </div>

    <header>
        <img src="{{ asset('imagenes/logo.png') }}" alt="Logo">
        <div>
            <h1>Crear Nuevo Usuario Autorizado</h1>
            <p>Registra meseros/empleados o asigna el segundo administrador permitido</p>
        </div>
    </header>

    <main>
        <div class="card-formulario">
            <h2>Datos del Trabajador o Administrador</h2>
            <p class="subtitulo">Solo las personas registradas aquí tendrán acceso interno al restaurante.</p>

            @if(session('error'))
                <div class="alerta-error">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alerta-error">
                    <strong>Por favor corrige los siguientes errores:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('usuarios.guardar') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Tipo de Cuenta y Rol:</label>
                    <div class="roles-grid">
                        {{-- OPCIÓN EMPLEADO (SIN LÍMITE) --}}
                        <label class="rol-opcion">
                            <input type="radio" name="rol" value="empleado" {{ old('rol', 'empleado') === 'empleado' ? 'checked' : '' }} required>
                            <div class="rol-box">
                                <span class="icono">🧑‍🍳</span>
                                <span class="titulo">Empleado / Mesero</span>
                                <span class="desc">Atención de mesas, pedidos, comandas y cobros.</span>
                            </div>
                        </label>

                        {{-- OPCIÓN ADMINISTRADOR (MÁXIMO 2) --}}
                        @if($totalAdmins >= 2)
                            <div class="rol-opcion rol-deshabilitado">
                                <div class="rol-box">
                                    <span class="icono">🛡️</span>
                                    <span class="titulo">Administrador</span>
                                    <span class="desc">Límite alcanzado (2/2 administradores activos).</span>
                                    <span class="aviso-limite">Máximo 2 administradores</span>
                                </div>
                            </div>
                        @else
                            <label class="rol-opcion">
                                <input type="radio" name="rol" value="admin" {{ old('rol') === 'admin' ? 'checked' : '' }} required>
                                <div class="rol-box">
                                    <span class="icono">🛡️</span>
                                    <span class="titulo">Administrador</span>
                                    <span class="desc">Control total del negocio, inventario, reportes y personal.</span>
                                    <span class="aviso-limite">{{ $totalAdmins }}/2 registrados</span>
                                </div>
                            </label>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="name">Nombre Completo:</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Ej. Carlos Martínez" required>
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico (para inicio de sesión):</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="ejemplo@mamaruby.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" placeholder="Mínimo 6 caracteres" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Contraseña:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite la contraseña" required>
                </div>

                <button type="submit" class="btn-guardar">💾 Registrar Usuario Autorizado</button>
            </form>

            <div class="volver">
                <a href="{{ route('usuarios.index') }}">← Cancelar y volver al listado</a>
            </div>
        </div>
    </main>

    <footer>
        <p>Las Delicias de Mamá Ruby © 2026</p>
    </footer>

</body>
</html>
