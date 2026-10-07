<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Iniciar Sesión - Las Delicias de Mamá Ruby</title>

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
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        header {
            background: linear-gradient(135deg, #f7b6d2, #f48fb1);
            padding: 20px;
            text-align: center;
            border-bottom: 5px solid #d4a017;
        }

        header img {
            width: 130px;
            height: 130px;
            object-fit: contain;
            background-color: white;
            border-radius: 50%;
            padding: 8px;
            margin-bottom: 8px;
        }

        header h1 {
            font-size: 26px;
            color: #4a2c2a;
        }

        .contenedor {
            width: 90%;
            max-width: 480px;
            margin: 40px auto;
        }

        .tarjeta-auth {
            background: white;
            padding: 35px 30px;
            border-radius: 18px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.09);
            border-top: 6px solid #d63384;
        }

        .tarjeta-auth h2 {
            color: #d63384;
            text-align: center;
            font-size: 24px;
            margin-bottom: 8px;
        }

        .tarjeta-auth p.subtitulo {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .campo {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: #4b2418;
            font-size: 14px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            background: white;
            transition: 0.2s;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #d63384;
            box-shadow: 0 0 0 3px rgba(214, 51, 132, 0.15);
        }

        .recordar-box {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 22px;
            font-size: 14px;
            color: #555;
        }

        .recordar-box input {
            cursor: pointer;
        }

        .boton-submit {
            width: 100%;
            background: #d63384;
            color: white;
            padding: 13px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .boton-submit:hover {
            background: #b82b70;
            transform: translateY(-1px);
        }

        .mensaje-alerta {
            background: #d4edda;
            border: 1px solid #a3cfbb;
            color: #155724;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }

        .error-texto {
            color: #b42318;
            font-size: 13px;
            margin-top: 5px;
        }

        .enlace-registro {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .enlace-registro a {
            color: #3b82c4;
            text-decoration: none;
            font-weight: bold;
        }

        .enlace-registro a:hover {
            text-decoration: underline;
        }

        .volver-inicio {
            text-align: center;
            margin-top: 20px;
        }

        .volver-inicio a {
            color: #666;
            text-decoration: none;
            font-size: 13px;
        }

        .volver-inicio a:hover {
            color: #d63384;
        }

        footer {
            background: #244a73;
            color: white;
            text-align: center;
            padding: 18px;
            margin-top: 40px;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <header>
        <img
            src="{{ asset('imagenes/logo.png') }}"
            alt="Logo Las Delicias de Mamá Ruby"
        >
        <h1>Las Delicias de Mamá Ruby</h1>
    </header>

    <main class="contenedor">

        <div class="tarjeta-auth">

            <h2>Iniciar Sesión</h2>
            <p class="subtitulo">Ingresa tus credenciales para acceder a la administración</p>

            @if(session('success'))
                <div class="mensaje-alerta">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login.iniciar') }}" method="POST">

                @csrf

                <div class="campo">
                    <label for="email">Correo electrónico</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="tu-correo@ejemplo.com"
                        required
                        autofocus
                    >
                    @error('email')
                        <div class="error-texto">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="password">Contraseña</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        required
                    >
                    @error('password')
                        <div class="error-texto">{{ $message }}</div>
                    @enderror
                </div>

                <div class="recordar-box">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember" style="margin-bottom: 0; font-weight: normal; cursor: pointer;">
                        Recordar mi sesión en este equipo
                    </label>
                </div>

                <button type="submit" class="boton-submit">
                    Ingresar al Sistema
                </button>

            </form>

            <div class="enlace-registro">
                ¿Aún no tienes cuenta?
                <a href="{{ route('registro') }}">Regístrate aquí</a>
            </div>

        </div>

        <div class="volver-inicio">
            <a href="/">← Volver al inicio</a>
        </div>

    </main>

    <footer>
        <p>Las Delicias de Mamá Ruby © 2026</p>
    </footer>

</body>
</html>
