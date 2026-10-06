<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inventario - Las Delicias de Mamá Ruby</title>

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

        header {
            background: linear-gradient(135deg, #f7b6d2, #f48fb1);
            padding: 20px;
            text-align: center;
            border-bottom: 5px solid #d4a017;
        }

        header img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            background-color: white;
            border-radius: 50%;
            padding: 6px;
        }

        header h1 {
            margin-top: 10px;
            color: #4a2c2a;
        }

        header p {
            color: #244a73;
            margin-top: 5px;
        }

        .contenedor {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .titulo {
            background-color: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.10);
        }

        .titulo h2 {
            color: #d14d72;
            margin-bottom: 10px;
        }

        .acciones {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .boton {
            display: inline-block;
            background-color: #d14d72;
            color: white;
            padding: 11px 20px;
            border-radius: 25px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        .boton:hover {
            background-color: #244a73;
        }

        .tabla-contenedor {
            background-color: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.10);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #244a73;
            color: white;
            padding: 14px;
            text-align: left;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background-color: #fff3f7;
        }

        .estado {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .disponible {
            background-color: #dff5e1;
            color: #287a35;
        }

        .bajo {
            background-color: #fff0c2;
            color: #8a6800;
        }

        .agotado {
            background-color: #ffd9d9;
            color: #a12a2a;
        }

        .volver {
            margin-top: 25px;
        }

        footer {
            margin-top: 50px;
            background-color: #244a73;
            color: white;
            text-align: center;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .acciones {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
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

        <h1>Las Delicias de Mamá Ruby</h1>

        <p>Gestión de inventario</p>

    </header>


    <main class="contenedor">

        <section class="titulo">

            <h2>Inventario</h2>

            <p>
                Consulta y controla los productos disponibles
                en el restaurante.
            </p>

        </section>


        <div class="acciones">

            <h3>Productos registrados</h3>

            <a href="#" class="boton">
                + Registrar producto
            </a>

        </div>


        <section class="tabla-contenedor">

            <table>

                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Cantidad</th>
                        <th>Unidad</th>
                        <th>Estado</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>Arroz</td>
                        <td>Alimentos</td>
                        <td>20</td>
                        <td>Kg</td>
                        <td>
                            <span class="estado disponible">
                                Disponible
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>Aceite</td>
                        <td>Alimentos</td>
                        <td>3</td>
                        <td>Litros</td>
                        <td>
                            <span class="estado bajo">
                                Stock bajo
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>Gaseosa</td>
                        <td>Bebidas</td>
                        <td>0</td>
                        <td>Unidades</td>
                        <td>
                            <span class="estado agotado">
                                Agotado
                            </span>
                        </td>
                    </tr>

                </tbody>

            </table>

        </section>


        <div class="volver">

            <a href="/" class="boton">
                ← Volver al inicio
            </a>

        </div>

    </main>


    <footer>

        <p>
            Las Delicias de Mamá Ruby © 2026
        </p>

    </footer>

</body>
</html>