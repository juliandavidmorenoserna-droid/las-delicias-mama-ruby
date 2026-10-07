<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro de Usuario - Las Delicias de Mamá Ruby</title>

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
            max-width: 500px;
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
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: #4b2418;
            font-size: 14px;
        }

        input[type="text"],
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

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #d63384;
            box-shadow: 0 0 0 3px rgba(214, 51, 132, 0.15);
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
            margin-top: 10px;
        }

        .boton-submit:hover {
            background: #b82b70;
            transform: translateY(-1px);
        }

        .error-texto {
            color: #b42318;
            font-size: 13px;
            margin-top: 5px;
        }

        .enlace-login {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .enlace-login a {
            color: #3b82c4;
            text-decoration: none;
            font-weight: bold;
        }

        .enlace-login a:hover {
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

            <h2>Crear Cuenta</h2>
            <p class="subtitulo">Regístrate para gestionar el sistema del restaurante</p>

            <form action="{{ route('registro.guardar') }}" method="POST">

                @csrf

                <div class="campo">
                    <label for="name">Nombre completo *</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Ejemplo: Julian Moreno"
                        required
                        autofocus
                    >
                    @error('name')
                        <div class="error-texto">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="email">Correo electrónico *</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="tu-correo@ejemplo.com"
                        required
                    >
                    @error('email')
                        <div class="error-texto">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="password">Contraseña *</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Mínimo 6 caracteres"
                        required
                    >
                    @error('password')
                        <div class="error-texto">{{ $message }}</div>
                    @enderror
                </div>

                <div class="campo">
                    <label for="password_confirmation">Confirmar contraseña *</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Repite la contraseña"
                        required
                    >
                </div>

                <button type="submit" class="boton-submit">
                    Registrarse e Ingresar
                </button>

            </form>

            <div class="enlace-login">
                ¿Ya tienes una cuenta registrada?
                <a href="{{ route('login') }}">Inicia sesión aquí</a>
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
