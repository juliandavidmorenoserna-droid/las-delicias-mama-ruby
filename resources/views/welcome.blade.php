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
            color: #4a2c2a;
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
            margin: 40px auto;
            padding: 0 20px;
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

        <!-- BIENVENIDA -->
        <section class="bienvenida">

            <h2>Bienvenido</h2>

            <p>
                Administra de manera sencilla la información del restaurante,
                el inventario, las ventas y los empleados.
            </p>

        </section>


        <!-- MÓDULOS -->
        <section class="modulos">

            <!-- INVENTARIO -->
            <div class="modulo">

                <div>
                    <h3>Inventario</h3>

                    <p>
                        Consulta y controla los insumos y stock disponibles.
                    </p>
                </div>

                <a href="/inventario" class="boton">
                    Ingresar
                </a>

            </div>


            <!-- VENTAS -->
            <div class="modulo">

                <div>
                    <h3>Ventas</h3>

                    <p>
                        Registra y consulta las ventas del restaurante.
                    </p>
                </div>

                <a href="/ventas" class="boton">
                    Ingresar
                </a>

            </div>


            <!-- EMPLEADOS -->
            <div class="modulo">

                <div>
                    <h3>Empleados</h3>

                    <p>
                        Gestiona la información de los empleados.
                    </p>
                </div>

                <a href="/empleados" class="boton">
                    Ingresar
                </a>

            </div>


            <!-- PAGOS -->
            <div class="modulo">

                <div>
                    <h3>Pagos</h3>

                    <p>
                        Controla los pagos realizados a los empleados.
                    </p>
                </div>

                <a href="/pagos" class="boton">
                    Ingresar
                </a>

            </div>


            <!-- PRODUCTOS -->
            <div class="modulo">

                <div>
                    <h3>Productos</h3>

                    <p>
                        Administra la carta de platos, bebidas y precios a la venta.
                    </p>
                </div>

                <a href="/productos" class="boton">
                    Ingresar
                </a>

            </div>


            <!-- REPORTES -->
            <div class="modulo">

                <div>
                    <h3>Reportes</h3>

                    <p>
                        Consulta información y resultados del sistema.
                    </p>
                </div>

                <a href="/reportes" class="boton">
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