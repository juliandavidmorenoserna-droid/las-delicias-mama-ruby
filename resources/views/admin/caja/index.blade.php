<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caja y Cobro de Mesas - Las Delicias de Mamá Ruby</title>

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
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
        }

        .header-brand {
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

        .btn-refrescar {
            background: #244a73;
            color: white;
            padding: 10px 18px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: 0.2s;
        }
        .btn-refrescar:hover {
            background: #193452;
            transform: scale(1.03);
        }

        /* ── MAIN ───────────────────────────────────────────── */
        main {
            max-width: 1250px;
            margin: 25px auto;
            padding: 0 20px;
            flex: 1;
            width: 100%;
        }

        /* ── ALERTAS ────────────────────────────────────────── */
        .alerta {
            padding: 14px 20px; border-radius: 10px;
            margin-bottom: 20px; font-weight: bold; text-align: center;
            font-size: 15px;
        }

        .alerta-exito {
            background: #d4edda; color: #155724; border: 1px solid #c3e6cb;
        }

        .alerta-error {
            background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;
        }

        /* ── MÉTRICAS SUPERIORES ────────────────────────────── */
        .metricas-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
        }

        .metrica-card {
            background: white;
            border-radius: 14px;
            padding: 18px 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .metrica-icono {
            font-size: 32px;
            width: 50px; height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .metrica-info h4 { font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 0.5px; }
        .metrica-info .valor { font-size: 22px; font-weight: bold; color: #4a2c2a; margin-top: 2px; }

        /* ── GRID DE MESAS ──────────────────────────────────── */
        .seccion-titulo {
            font-size: 20px;
            color: #4a2c2a;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .grid-mesas {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 20px;
        }

        /* ── TARJETA DE MESA ────────────────────────────────── */
        .tarjeta-mesa {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            border-top: 6px solid #244a73;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .tarjeta-mesa:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.12);
        }

        .tarjeta-mesa.cuenta-pedida {
            border-top-color: #e67e22;
            animation: bordePulso 2s infinite;
        }

        @keyframes bordePulso {
            0%, 100% { box-shadow: 0 4px 15px rgba(230, 126, 34, 0.2); }
            50% { box-shadow: 0 4px 22px rgba(230, 126, 34, 0.4); }
        }

        .mesa-header {
            padding: 16px 20px;
            background: #faf6f4;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f0e6e2;
        }

        .mesa-header h3 {
            font-size: 18px;
            color: #4a2c2a;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .badge-estado {
            font-size: 11px;
            font-weight: bold;
            padding: 4px 10px;
            border-radius: 12px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .badge-abierta {
            background: #e8f0fe;
            color: #1a56c4;
        }

        .badge-por-cobrar {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        .mesa-body {
            padding: 18px 20px;
            flex: 1;
        }

        .mesa-info-mesero {
            font-size: 13px;
            color: #666;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .mesa-info-mesero strong {
            color: #244a73;
        }

        /* ── TABLA DE PLATOS ────────────────────────────────── */
        .tabla-platos {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 13px;
        }

        .tabla-platos th {
            text-align: left;
            padding: 6px 4px;
            color: #888;
            font-weight: 600;
            border-bottom: 1px solid #eee;
            font-size: 11px;
            text-transform: uppercase;
        }

        .tabla-platos td {
            padding: 8px 4px;
            border-bottom: 1px solid #f8f2ef;
            vertical-align: middle;
        }

        .tabla-platos .col-subtotal {
            text-align: right;
            font-weight: bold;
            color: #d14d72;
        }

        /* ── CUADRO TOTAL A COBRAR ──────────────────────────── */
        .cuadro-total {
            background: linear-gradient(135deg, #244a73, #193452);
            color: white;
            border-radius: 12px;
            padding: 14px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .cuadro-total .label {
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: #d1e2f7;
        }

        .cuadro-total .monto {
            font-size: 24px;
            font-weight: bold;
            color: #f2c94c;
        }

        /* ── ACCIONES Y FORMULARIO DE COBRO ─────────────────── */
        .mesa-footer {
            padding: 16px 20px;
            background: #faf6f4;
            border-top: 1px solid #f0e6e2;
        }

        .btn-abrir-cobro {
            background: #28a745;
            color: white;
            border: none;
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-abrir-cobro:hover {
            background: #218838;
            transform: translateY(-1px);
        }

        /* ── MODAL / DESPLEGABLE DE COBRO ───────────────────── */
        .modal-cobro {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .modal-contenido {
            background: white;
            border-radius: 18px;
            max-width: 480px;
            width: 100%;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
            position: relative;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
            border-bottom: 2px solid #f4e8e2;
            padding-bottom: 10px;
        }

        .modal-header h3 {
            color: #4a2c2a;
            font-size: 19px;
        }

        .btn-cerrar-modal {
            background: none;
            border: none;
            font-size: 22px;
            cursor: pointer;
            color: #999;
        }

        .btn-cerrar-modal:hover { color: #333; }

        .form-campo {
            margin-bottom: 14px;
        }

        .form-campo label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 6px;
            color: #4a2c2a;
        }

        .form-campo select,
        .form-campo input {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid #d1b8b0;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
        }

        .form-campo select:focus,
        .form-campo input:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.15);
        }

        .cambio-box {
            background: #e8f5e9;
            border: 1px solid #c8e6c9;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            color: #2e7d32;
            font-weight: bold;
        }

        .btn-confirmar-cobro {
            background: #28a745;
            color: white;
            border: none;
            width: 100%;
            padding: 14px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-confirmar-cobro:hover {
            background: #218838;
        }

        /* ── ESTADO VACÍO ───────────────────────────────────── */
        .estado-vacio {
            background: white;
            border-radius: 16px;
            padding: 50px 20px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            margin: 20px 0;
        }

        .estado-vacio .icono { font-size: 50px; margin-bottom: 12px; }
        .estado-vacio h3 { color: #4a2c2a; font-size: 20px; margin-bottom: 8px; }
        .estado-vacio p { color: #777; font-size: 14px; }

        footer {
            background: #244a73; color: white;
            text-align: center; padding: 18px;
            margin-top: 40px; font-size: 13px;
        }
    </style>
</head>

<body>

    {{-- BARRA TOP --}}
    <div class="barra-top">
        <span><a href="{{ route('inicio') }}">← Panel Admin Principal</a></span>
        <div style="display:flex; align-items:center; gap:12px;">
            <span>🛡️ <strong>{{ Auth::user()->name }}</strong> (Cajera / Administradora)</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">Cerrar Sesión</button>
            </form>
        </div>
    </div>

    {{-- HEADER --}}
    <header>
        <div class="header-brand">
            <img src="{{ asset('imagenes/logo.png') }}" alt="Logo">
            <div>
                <h1>💵 Caja y Cobro de Mesas en Vivo</h1>
                <p>Monitoreo en tiempo real de mesas atendidas por meseros y cobro de cuentas</p>
            </div>
        </div>
        <div>
            <a href="{{ route('admin.caja.index') }}" class="btn-refrescar" title="Actualizar mesas">
                🔄 Actualizar Caja
            </a>
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

        {{-- MÉTRICAS RESUMEN --}}
        <div class="metricas-grid">
            <div class="metrica-card">
                <div class="metrica-icono" style="background:#e8f5e9; color:#2e7d32;">💰</div>
                <div class="metrica-info">
                    <h4>Total Pendiente por Cobrar</h4>
                    <div class="valor">${{ number_format($totalPendiente, 2) }}</div>
                </div>
            </div>

            <div class="metrica-card">
                <div class="metrica-icono" style="background:#fff3cd; color:#856404;">🔔</div>
                <div class="metrica-info">
                    <h4>Cuentas Pedidas (Listas)</h4>
                    <div class="valor">{{ $cuentasListas }} mesa(s)</div>
                </div>
            </div>

            <div class="metrica-card">
                <div class="metrica-icono" style="background:#e8f0fe; color:#1a56c4;">🍽️</div>
                <div class="metrica-info">
                    <h4>Mesas con Consumo Activo</h4>
                    <div class="valor">{{ $mesasConComanda->count() }} mesa(s)</div>
                </div>
            </div>
        </div>

        {{-- GRID DE MESAS --}}
        <h2 class="seccion-titulo">
            📋 Mesas con Cuentas y Platos Tomados
        </h2>

        @if($mesasConComanda->isEmpty())
            <div class="estado-vacio">
                <div class="icono">✨</div>
                <h3>¡Todo al día en Caja!</h3>
                <p>En este momento no hay mesas con consumo activo ni cuentas pendientes por cobrar.<br>Cuando los meseros tomen pedidos en las mesas, aparecerán aquí automáticamente con el valor total a cobrar.</p>
            </div>
        @else
            <div class="grid-mesas">
                @foreach($mesasConComanda as $mesa)
                    @php
                        $comanda = $mesa->pedidos->first();
                        $esCuentaPedida = ($comanda && $comanda->estado === 'Por Cobrar');
                    @endphp

                    <div class="tarjeta-mesa {{ $esCuentaPedida ? 'cuenta-pedida' : '' }}">
                        <div class="mesa-header">
                            <h3>
                                <span>🍽️ {{ $mesa->numero }}</span>
                            </h3>

                            @if($esCuentaPedida)
                                <span class="badge-estado badge-por-cobrar">🔔 Cuenta Solicitada</span>
                            @else
                                <span class="badge-estado badge-abierta">🍴 En Consumo</span>
                            @endif
                        </div>

                        <div class="mesa-body">
                            <div class="mesa-info-mesero">
                                🧑‍🍳 Atendida por: <strong>{{ $comanda->mesero ?? 'Mesero en turno' }}</strong>
                            </div>

                            @if($comanda && $comanda->detalles->isNotEmpty())
                                <table class="tabla-platos">
                                    <thead>
                                        <tr>
                                            <th>Plato / Bebida</th>
                                            <th style="text-align:center;">Cant.</th>
                                            <th style="text-align:right;">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($comanda->detalles as $detalle)
                                            <tr>
                                                <td><strong>{{ $detalle->nombre_producto }}</strong></td>
                                                <td style="text-align:center;">{{ $detalle->cantidad }}</td>
                                                <td class="col-subtotal">${{ number_format($detalle->subtotal, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p style="font-size:13px; color:#999; margin:15px 0; text-align:center;">
                                    <em>(Mesa ocupada, pero aún sin platos registrados)</em>
                                </p>
                            @endif

                            {{-- VALOR TOTAL A COBRAR --}}
                            <div class="cuadro-total">
                                <span class="label">VALOR A COBRAR:</span>
                                <span class="monto">${{ number_format($comanda ? $comanda->total : 0, 2) }}</span>
                            </div>
                        </div>

                        <div class="mesa-footer">
                            @if($comanda && $comanda->detalles->isNotEmpty())
                                <button
                                    type="button"
                                    class="btn-abrir-cobro"
                                    onclick="abrirModalCobro('{{ $comanda->id }}', '{{ $mesa->numero }}', '{{ $comanda->total }}')"
                                >
                                    💵 Cobrar Mesa ({{ $mesa->numero }})
                                </button>
                            @else
                                <button type="button" class="btn-abrir-cobro" disabled style="opacity:0.5; cursor:not-allowed;">
                                    Sin ítems para cobrar
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </main>

    {{-- MODAL DE COBRO DE LA ADMINISTRADORA --}}
    <div id="modalCobro" class="modal-cobro">
        <div class="modal-contenido">
            <div class="modal-header">
                <h3 id="modalTitulo">💵 Cobrar Mesa</h3>
                <button type="button" class="btn-cerrar-modal" onclick="cerrarModalCobro()">✕</button>
            </div>

            <form id="formCobro" action="" method="POST">
                @csrf

                <div class="form-campo">
                    <label>Valor Total a Cobrar:</label>
                    <input type="text" id="modalTotalVisible" value="$0.00" readonly style="font-size:18px; font-weight:bold; color:#d14d72; background:#f9f9f9;">
                </div>

                <div class="form-campo">
                    <label for="metodo_pago">Método de Pago *:</label>
                    <select id="metodo_pago" name="metodo_pago" required onchange="cambioMetodoPago()">
                        <option value="Efectivo">💵 Efectivo</option>
                        <option value="Transferencia Nequi / Daviplata">📲 Transferencia (Nequi / Daviplata)</option>
                        <option value="Tarjeta de Débito">💳 Tarjeta Débito</option>
                        <option value="Tarjeta de Crédito">💳 Tarjeta Crédito</option>
                        <option value="Transferencia Bancolombia">🏦 Transferencia Bancaria</option>
                    </select>
                </div>

                <div class="form-campo" id="campoMontoRecibido">
                    <label for="monto_recibido">Monto Recibido en Efectivo ($):</label>
                    <input type="number" step="0.01" id="monto_recibido" name="monto_recibido" placeholder="Ej: 50000" oninput="calcularDevuelta()">
                </div>

                <div id="boxDevuelta" class="cambio-box" style="display:none;">
                    <span>Devuelta / Cambio al cliente:</span>
                    <span id="valorDevuelta">$0.00</span>
                </div>

                <div class="form-campo">
                    <label for="cliente">Nombre del Cliente (opcional):</label>
                    <input type="text" id="cliente" name="cliente" placeholder="Ej: Familia Gómez / Mesa 1">
                </div>

                <div class="form-campo">
                    <label for="notas">Notas de la Venta (opcional):</label>
                    <input type="text" id="notas" name="notas" placeholder="Ej: Descuento aplicado, propina, etc.">
                </div>

                <button type="submit" class="btn-confirmar-cobro">
                    ✅ Confirmar Cobro y Liberar Mesa
                </button>
            </form>
        </div>
    </div>

    <footer>
        <p>Las Delicias de Mamá Ruby © 2026 · Panel de Administración y Caja</p>
    </footer>

    <script>
        let totalComandaActual = 0;

        function abrirModalCobro(comandaId, nombreMesa, total) {
            totalComandaActual = parseFloat(total);

            document.getElementById('modalTitulo').innerText = '💵 Cobrar ' + nombreMesa;
            document.getElementById('modalTotalVisible').value = '$' + totalComandaActual.toLocaleString('es-CO', { minimumFractionDigits: 2 });
            document.getElementById('formCobro').action = '/caja/' + comandaId + '/cobrar';
            document.getElementById('monto_recibido').value = '';
            document.getElementById('boxDevuelta').style.display = 'none';

            document.getElementById('modalCobro').style.display = 'flex';
        }

        function cerrarModalCobro() {
            document.getElementById('modalCobro').style.display = 'none';
        }

        function cambioMetodoPago() {
            const metodo = document.getElementById('metodo_pago').value;
            const campoEfectivo = document.getElementById('campoMontoRecibido');
            const boxDevuelta = document.getElementById('boxDevuelta');

            if (metodo === 'Efectivo') {
                campoEfectivo.style.display = 'block';
            } else {
                campoEfectivo.style.display = 'none';
                boxDevuelta.style.display = 'none';
            }
        }

        function calcularDevuelta() {
            const recibido = parseFloat(document.getElementById('monto_recibido').value) || 0;
            const boxDevuelta = document.getElementById('boxDevuelta');
            const valorDevuelta = document.getElementById('valorDevuelta');

            if (recibido >= totalComandaActual) {
                const cambio = recibido - totalComandaActual;
                valorDevuelta.innerText = '$' + cambio.toLocaleString('es-CO', { minimumFractionDigits: 2 });
                boxDevuelta.style.display = 'flex';
                boxDevuelta.style.background = '#e8f5e9';
                boxDevuelta.style.color = '#2e7d32';
            } else if (recibido > 0) {
                const falta = totalComandaActual - recibido;
                valorDevuelta.innerText = 'Faltan: $' + falta.toLocaleString('es-CO', { minimumFractionDigits: 2 });
                boxDevuelta.style.display = 'flex';
                boxDevuelta.style.background = '#ffebee';
                boxDevuelta.style.color = '#c62828';
            } else {
                boxDevuelta.style.display = 'none';
            }
        }

        // Cerrar modal al presionar escape o click fuera
        window.onclick = function(event) {
            const modal = document.getElementById('modalCobro');
            if (event.target === modal) {
                cerrarModalCobro();
            }
        }
    </script>

</body>
</html>
