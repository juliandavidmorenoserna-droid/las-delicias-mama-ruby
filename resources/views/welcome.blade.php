<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Las Delicias de Mamá Ruby</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #fff8f2;
            color: #4b2418;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* BARRA SUPERIOR DE AUTENTICACIÓN */
        .barra-auth {
            background-color: #244a73;
            color: white;
            padding: 10px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
        }

        .auth-usuario {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .auth-usuario strong {
            color: #f2c94c;
        }

        .auth-botones {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn-auth {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            transition: 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-login {
            background-color: transparent;
            color: white;
            border: 1px solid white;
        }

        .btn-login:hover {
            background-color: white;
            color: #244a73;
        }

        .btn-registro {
            background-color: #d14d72;
            color: white;
        }

        .btn-registro:hover {
            background-color: #b82b70;
        }

        .btn-logout {
            background-color: #c93b3b;
            color: white;
        }

        .btn-logout:hover {
            background-color: #a32828;
        }

        /* ENCABEZADO */
        header {
            background: linear-gradient(135deg, #f7b6d2, #f48fb1);
            padding: 25px 20px;
            text-align: center;
            border-bottom: 5px solid #d4a017;
        }

        header img {
            width: 150px;
            height: 150px;
            object-fit: contain;
            background-color: white;
            border-radius: 50%;
            padding: 8px;
            margin-bottom: 10px;
        }

        header h1 {
            font-size: 32px;
            color: #4a2c2a;
            margin-bottom: 8px;
        }

        header p {
            font-size: 17px;
            color: #244a73;
        }

        /* CONTENEDOR */
        .contenedor {
            max-width: 1100px;
            margin: 35px auto;
            padding: 0 20px;
            flex: 1;
        }

        /* ALERTA DE SESIÓN */
        .alerta-exito {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 14px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            text-align: center;
            font-weight: bold;
        }

        /* BIENVENIDA */
        .bienvenida {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.12);
        }

        .bienvenida h2 {
            color: #d14d72;
            margin-bottom: 12px;
            font-size: 27px;
        }

        .bienvenida p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }

        /* MÓDULOS */
        .modulos {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .modulo {
            background-color: white;
            padding: 30px 20px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.10);
            border-top: 5px solid #f48fb1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: 0.2s;
        }

        .modulo:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.14);
        }

        .modulo h3 {
            color: #244a73;
            margin-bottom: 10px;
            font-size: 21px;
        }

        .modulo p {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.5;
            font-size: 14px;
        }

        /* BOTONES */
        .boton {
            display: inline-block;
            background-color: #d14d72;
            color: white;
            padding: 10px 22px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .boton:hover {
            background-color: #244a73;
            transform: scale(1.05);
        }

        /* PIE DE PÁGINA */
        footer {
            margin-top: 50px;
            background-color: #244a73;
            color: white;
            text-align: center;
            padding: 20px;
        }

        footer p {
            margin: 0;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .barra-auth {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }

            header h1 {
                font-size: 25px;
            }

            header img {
                width: 120px;
                height: 120px;
            }

            .modulos {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- BARRA SUPERIOR DE AUTENTICACIÓN -->
    <div class="barra-auth">
        @auth
            <div class="auth-usuario">
                <span>👋 Conectado como: <strong>{{ Auth::user()->name }}</strong></span>
                <span style="opacity: 0.7; font-size: 12px;">({{ Auth::user()->email }})</span>
            </div>

            <div class="auth-botones">
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-auth btn-logout">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        @else
            <div class="auth-usuario">
                <span>🔒 Área administrativa del restaurante</span>
            </div>

            <div class="auth-botones">
                <a href="{{ route('login') }}" class="btn-auth btn-login">
                    Iniciar Sesión
                </a>
                <a href="{{ route('registro') }}" class="btn-auth btn-registro">
                    Registrarse
                </a>
            </div>
        @endauth
    </div>

    <!-- ENCABEZADO -->
    <header>

        <img
            src="{{ asset('imagenes/logo.png') }}"
            alt="Logo Las Delicias de Mamá Ruby"
        >

        <h1>Las Delicias de Mamá Ruby</h1>

        <p>Sistema de gestión del restaurante</p>

    </header>


    <!-- CONTENIDO PRINCIPAL -->
    <main class="contenedor">

        @if(session('success'))
            <div class="alerta-exito">
                {{ session('success') }}
            </div>
        @endif

        <!-- BIENVENIDA -->
        <section class="bienvenida">

            <h2>Bienvenido</h2>

            <p>
                Administra de manera sencilla la información del restaurante,
                el inventario, las ventas, el personal y los reportes operativos.
            </p>

        </section>


        <!-- MÓDULOS -->
        <section class="modulos">

            <!-- INVENTARIO -->
            <div class="modulo">

                <div>
                    <h3>Inventario</h3>

                    <p>
                        Consulta y controla los insumos y stock disponibles en cocina.
                    </p>
                </div>

                <a href="{{ route('inventario.index') }}" class="boton">
                    Ingresar
                </a>

            </div>


            <!-- VENTAS -->
            <div class="modulo">

                <div>
                    <h3>Ventas</h3>

                    <p>
                        Registra comandas, facturación y consulta las ventas del restaurante.
                    </p>
                </div>

                <a href="{{ route('ventas.index') }}" class="boton">
                    Ingresar
                </a>

            </div>


            <!-- EMPLEADOS -->
            <div class="modulo">

                <div>
                    <h3>Empleados</h3>

                    <p>
                        Gestiona el personal, cargos, salarios y fechas de ingreso.
                    </p>
                </div>

                <a href="{{ route('empleados.index') }}" class="boton">
                    Ingresar
                </a>

            </div>


            <!-- PAGOS -->
            <div class="modulo">

                <div>
                    <h3>Pagos</h3>

                    <p>
                        Controla los pagos de nómina, quincenas y recibos de colaboradores.
                    </p>
                </div>

                <a href="{{ route('pagos.index') }}" class="boton">
                    Ingresar
                </a>

            </div>


            <!-- PRODUCTOS -->
            <div class="modulo">

                <div>
                    <h3>Productos</h3>

                    <p>
                        Administra la carta de platos, bebidas y precios al público.
                    </p>
                </div>

                <a href="{{ route('productos.index') }}" class="boton">
                    Ingresar
                </a>

            </div>


            <!-- REPORTES -->
            <div class="modulo">

                <div>
                    <h3>Reportes</h3>

                    <p>
                        Consulta métricas, balance operativo, ventas y estado de stock.
                    </p>
                </div>

                <a href="{{ route('reportes.index') }}" class="boton">
                    Ingresar
                </a>

            </div>

        </section>

    </main>


    <!-- PIE DE PÁGINA -->
    <footer>

        <p>
            Las Delicias de Mamá Ruby © 2026
        </p>

    </footer>

</body>
</html>