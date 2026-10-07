<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrar Venta - Las Delicias de Mamá Ruby</title>

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
            max-width: 900px;
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

        .fila-campos {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .campo {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #4b2418;
            font-size: 14px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            background: white;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #d63384;
        }

        .seccion-productos {
            border-top: 2px dashed #f2c94c;
            padding-top: 25px;
            margin-top: 25px;
        }

        .seccion-titulo {
            font-size: 18px;
            color: #244a73;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .selector-box {
            display: flex;
            gap: 12px;
            align-items: flex-end;
            background: #fffaf2;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #ebd9c6;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .selector-campo {
            flex: 2;
            min-width: 220px;
        }

        .selector-cantidad {
            flex: 1;
            min-width: 120px;
        }

        .btn-agregar {
            background: #3b82c4;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
            height: 44px;
        }

        .btn-agregar:hover {
            background: #2d6fa8;
        }

        .tabla-items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 25px;
        }

        .tabla-items th {
            background: #244a73;
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }

        .tabla-items td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .btn-quitar {
            background: #c93b3b;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
        }

        .resumen-total-box {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 20px;
            background: #f7e6ec;
            padding: 18px 25px;
            border-radius: 12px;
            margin-top: 10px;
            margin-bottom: 25px;
        }

        .total-etiqueta {
            font-size: 18px;
            font-weight: bold;
            color: #4b2418;
        }

        .total-valor {
            font-size: 26px;
            font-weight: bold;
            color: #d63384;
        }

        .error {
            color: #b42318;
            font-size: 14px;
            margin-top: 5px;
        }

        .mensaje-error-global {
            background: #f8d7da;
            border: 1px solid #f5c2c7;
            color: #842029;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .botones {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .boton {
            flex: 1;
            display: inline-block;
            text-align: center;
            background: #d63384;
            color: white;
            text-decoration: none;
            padding: 14px 20px;
            border-radius: 10px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            font-size: 16px;
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

        @media (max-width: 768px) {
            .fila-campos {
                grid-template-columns: 1fr;
            }

            .tarjeta {
                padding: 22px;
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

            <h1>Registrar Nueva Venta</h1>

            <p class="descripcion">
                Selecciona los platos consumidos y registra el pago. El stock del inventario se descontará automáticamente.
            </p>

            @if(session('error'))
                <div class="mensaje-error-global">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('ventas.guardar') }}" method="POST" id="formVenta">

                @csrf

                <!-- DATOS DE LA VENTA -->
                <div class="fila-campos">

                    <div class="campo">
                        <label for="fecha">Fecha y Hora *</label>
                        <input
                            type="datetime-local"
                            id="fecha"
                            name="fecha"
                            value="{{ old('fecha', now()->format('Y-m-d\TH:i')) }}"
                            required
                        >
                    </div>

                    <div class="campo">
                        <label for="metodo_pago">Método de Pago *</label>
                        <select id="metodo_pago" name="metodo_pago" required>
                            <option value="Efectivo" {{ old('metodo_pago') == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                            <option value="Transferencia / Nequi / Daviplata" {{ old('metodo_pago') == 'Transferencia / Nequi / Daviplata' ? 'selected' : '' }}>Transferencia (Nequi / Daviplata)</option>
                            <option value="Tarjeta Débito / Crédito" {{ old('metodo_pago') == 'Tarjeta Débito / Crédito' ? 'selected' : '' }}>Tarjeta Débito / Crédito</option>
                        </select>
                    </div>

                    <div class="campo">
                        <label for="cliente">Mesa o Cliente</label>
                        <input
                            type="text"
                            id="cliente"
                            name="cliente"
                            value="{{ old('cliente') }}"
                            placeholder="Ej: Mesa 3 / Carlos Gómez"
                        >
                    </div>

                </div>

                <div class="campo">
                    <label for="notas">Notas u Observaciones (opcional)</label>
                    <input
                        type="text"
                        id="notas"
                        name="notas"
                        value="{{ old('notas') }}"
                        placeholder="Ej: Sin cebolla, extra salsa..."
                    >
                </div>

                <!-- SELECTOR DE PRODUCTOS -->
                <div class="seccion-productos">

                    <div class="seccion-titulo">
                        🍽️ Agregar productos a la comanda
                    </div>

                    <div class="selector-box">

                        <div class="selector-campo">
                            <label for="sel_producto">Producto del Menú</label>
                            <select id="sel_producto">
                                <option value="">-- Selecciona un producto --</option>
                                @foreach($productos as $prod)
                                    @php
                                        $stockInfo = '';
                                        $maxStock = 999999;
                                        if ($prod->inventario) {
                                            $maxStock = (float)$prod->inventario->cantidad;
                                            $stockInfo = ' [Stock: ' . $prod->inventario->cantidad . ' ' . $prod->inventario->unidad . ']';
                                        }
                                    @endphp
                                    <option
                                        value="{{ $prod->id }}"
                                        data-nombre="{{ $prod->nombre }}"
                                        data-precio="{{ $prod->precio }}"
                                        data-stock="{{ $maxStock }}"
                                        data-stockinfo="{{ $stockInfo }}"
                                    >
                                        {{ $prod->nombre }} - ${{ number_format($prod->precio, 2) }} {{ $stockInfo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="selector-cantidad">
                            <label for="sel_cantidad">Cantidad</label>
                            <input type="number" id="sel_cantidad" value="1" min="1" step="1">
                        </div>

                        <button type="button" class="btn-agregar" id="btnAgregarItem">
                            + Agregar
                        </button>

                    </div>

                    <!-- TABLA DE ARTÍCULOS SELECCIONADOS -->
                    <table class="tabla-items" id="tablaItems">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio Unitario</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="listaItems">
                            <tr id="filaVacia">
                                <td colspan="5" style="text-align: center; color: #888; padding: 20px;">
                                    Ningún producto agregado aún.
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- TOTAL ACUMULADO -->
                    <div class="resumen-total-box">
                        <span class="total-etiqueta">TOTAL A PAGAR:</span>
                        <span class="total-valor" id="totalVisual">$0.00</span>
                    </div>

                </div>

                <div class="botones">
                    <a href="{{ route('ventas.index') }}" class="boton boton-secundario">
                        Cancelar
                    </a>

                    <button type="submit" class="boton" id="btnGuardarVenta">
                        💾 Registrar y Finalizar Venta
                    </button>
                </div>

            </form>

        </div>

    </main>

    <!-- JAVASCRIPT INTERACTIVO -->
    <script>
        let itemsAgregados = [];

        const selProducto = document.getElementById('sel_producto');
        const selCantidad = document.getElementById('sel_cantidad');
        const btnAgregar = document.getElementById('btnAgregarItem');
        const listaItems = document.getElementById('listaItems');
        const totalVisual = document.getElementById('totalVisual');
        const formVenta = document.getElementById('formVenta');

        btnAgregar.addEventListener('click', function() {
            const prodId = selProducto.value;
            const cantidad = parseFloat(selCantidad.value);

            if (!prodId) {
                alert('Por favor selecciona un producto.');
                return;
            }

            if (isNaN(cantidad) || cantidad <= 0) {
                alert('La cantidad debe ser mayor a 0.');
                return;
            }

            const optionSeleccionada = selProducto.options[selProducto.selectedIndex];
            const nombre = optionSeleccionada.getAttribute('data-nombre');
            const precio = parseFloat(optionSeleccionada.getAttribute('data-precio'));
            const stockDisponible = parseFloat(optionSeleccionada.getAttribute('data-stock'));

            // Validar stock en frontend
            const itemExistente = itemsAgregados.find(i => i.id === prodId);
            const cantidadTotalSolicitada = (itemExistente ? itemExistente.cantidad : 0) + cantidad;

            if (stockDisponible !== 999999 && cantidadTotalSolicitada > stockDisponible) {
                alert('¡Stock insuficiente en inventario! Solo quedan ' + stockDisponible + ' unidades disponibles para este producto.');
                return;
            }

            if (itemExistente) {
                itemExistente.cantidad += cantidad;
                itemExistente.subtotal = itemExistente.cantidad * itemExistente.precio;
            } else {
                itemsAgregados.push({
                    id: prodId,
                    nombre: nombre,
                    precio: precio,
                    cantidad: cantidad,
                    subtotal: cantidad * precio
                });
            }

            renderizarTabla();
            selCantidad.value = 1;
        });

        function renderizarTabla() {
            listaItems.innerHTML = '';

            if (itemsAgregados.length === 0) {
                listaItems.innerHTML = `
                    <tr id="filaVacia">
                        <td colspan="5" style="text-align: center; color: #888; padding: 20px;">
                            Ningún producto agregado aún.
                        </td>
                    </tr>
                `;
                totalVisual.textContent = '$0.00';
                return;
            }

            let total = 0;

            itemsAgregados.forEach((item, index) => {
                total += item.subtotal;

                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td><strong>${item.nombre}</strong></td>
                    <td>$${item.precio.toLocaleString('es-CO', { minimumFractionDigits: 2 })}</td>
                    <td>${item.cantidad}</td>
                    <td><strong>$${item.subtotal.toLocaleString('es-CO', { minimumFractionDigits: 2 })}</strong></td>
                    <td>
                        <button type="button" class="btn-quitar" onclick="quitarItem(${index})">Quitar</button>
                        <input type="hidden" name="productos[${index}][id]" value="${item.id}">
                        <input type="hidden" name="productos[${index}][cantidad]" value="${item.cantidad}">
                    </td>
                `;
                listaItems.appendChild(tr);
            });

            totalVisual.textContent = '$' + total.toLocaleString('es-CO', { minimumFractionDigits: 2 });
        }

        window.quitarItem = function(index) {
            itemsAgregados.splice(index, 1);
            renderizarTabla();
        };

        formVenta.addEventListener('submit', function(e) {
            if (itemsAgregados.length === 0) {
                e.preventDefault();
                alert('Debes agregar al menos un producto a la comanda antes de registrar la venta.');
            }
        });
    </script>

</body>
</html>
