<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comanda – {{ $mesa->numero }} · Las Delicias de Mamá Ruby</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f8ff;
            color: #1a2b4a;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── BARRA SUPERIOR ─────────────────────────────────── */
        .barra-top {
            background: #244a73;
            color: white;
            padding: 10px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
        }

        .barra-top a {
            color: #f2c94c;
            text-decoration: none;
            font-weight: bold;
        }

        .barra-top a:hover { text-decoration: underline; }

        .btn-logout {
            background: #c93b3b;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 13px;
            font-weight: bold;
            transition: 0.2s;
        }

        .btn-logout:hover { background: #a32828; }

        /* ── HEADER ─────────────────────────────────────────── */
        header {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            padding: 18px 25px;
            color: white;
            display: flex;
            align-items: center;
            gap: 18px;
            border-bottom: 4px solid #f2c94c;
        }

        header img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: contain;
            background: white;
            padding: 4px;
        }

        header h1 { font-size: 21px; }
        header p  { font-size: 13px; color: #b0c4e4; margin-top: 3px; }

        /* ── MAIN LAYOUT ────────────────────────────────────── */
        main {
            max-width: 1100px;
            margin: 25px auto;
            padding: 0 20px;
            flex: 1;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 25px;
            align-items: start;
        }

        /* ── ALERTAS ────────────────────────────────────────── */
        .alerta {
            padding: 13px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
            font-size: 14px;
        }

        .alerta-exito {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alerta-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* ── SECCIÓN IZQUIERDA: AGREGAR PLATO ───────────────── */
        .panel {
            background: white;
            border-radius: 15px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .panel-header {
            background: #1e3c72;
            color: white;
            padding: 15px 20px;
            font-size: 16px;
            font-weight: bold;
        }

        .panel-body {
            padding: 20px;
        }

        /* ── AGREGAR PLATO FORM ──────────────────────────────── */
        .form-agregar {
            display: flex;
            gap: 12px;
            align-items: flex-end;
            flex-wrap: wrap;
            margin-bottom: 5px;
        }

        .campo-form {
            flex: 1;
            min-width: 160px;
        }

        .campo-form label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 6px;
            color: #4b2418;
        }

        .campo-form select,
        .campo-form input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            transition: 0.2s;
        }

        .campo-form select:focus,
        .campo-form input:focus {
            outline: none;
            border-color: #1e3c72;
            box-shadow: 0 0 0 3px rgba(30, 60, 114, 0.12);
        }

        .btn-agregar {
            background: #1e3c72;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
            white-space: nowrap;
        }

        .btn-agregar:hover {
            background: #163060;
            transform: translateY(-1px);
        }

        /* ── CATÁLOGO DE PRODUCTOS ───────────────────────────── */
        .catalogo-titulo {
            font-size: 15px;
            font-weight: bold;
            color: #555;
            margin: 20px 0 12px;
        }

        .catalogo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
        }

        .catalogo-cat {
            margin-bottom: 20px;
        }

        .catalogo-cat-titulo {
            font-size: 13px;
            font-weight: bold;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 2px solid #f0f0f0;
        }

        .producto-btn {
            background: #f8f9ff;
            border: 2px solid #e0e5ff;
            border-radius: 10px;
            padding: 12px 10px;
            text-align: center;
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .producto-btn:hover {
            border-color: #1e3c72;
            background: #eef1fb;
        }

        .producto-btn.seleccionado {
            border-color: #1e3c72;
            background: #dde4f5;
        }

        .prod-nombre {
            font-size: 13px;
            font-weight: bold;
            color: #1a2b4a;
        }

        .prod-precio {
            font-size: 14px;
            color: #d14d72;
            font-weight: bold;
        }

        /* ── SECCIÓN DERECHA: COMANDA ────────────────────────── */
        .comanda-panel {
            position: sticky;
            top: 20px;
        }

        .comanda-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 18px;
        }

        .info-item {
            background: #f0f4ff;
            border-radius: 10px;
            padding: 12px;
            text-align: center;
        }

        .info-label {
            font-size: 11px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 4px;
        }

        .info-valor {
            font-size: 15px;
            font-weight: bold;
            color: #1e3c72;
        }

        /* ── LISTA DE ITEMS ──────────────────────────────────── */
        .items-lista {
            list-style: none;
        }

        .items-lista li {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
            gap: 10px;
        }

        .items-lista li:last-child { border-bottom: none; }

        .item-nombre {
            font-size: 14px;
            font-weight: bold;
            color: #1a2b4a;
        }

        .item-cantidad {
            font-size: 12px;
            color: #888;
        }

        .item-subtotal {
            font-size: 15px;
            font-weight: bold;
            color: #d14d72;
            white-space: nowrap;
        }

        .btn-quitar {
            background: none;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            width: 26px;
            height: 26px;
            cursor: pointer;
            font-size: 14px;
            line-height: 1;
            color: #999;
            transition: 0.2s;
            flex-shrink: 0;
        }

        .btn-quitar:hover {
            background: #f8d7da;
            border-color: #dc3545;
            color: #dc3545;
        }

        /* ── TOTAL ───────────────────────────────────────────── */
        .total-box {
            background: #1e3c72;
            color: white;
            border-radius: 12px;
            padding: 18px 20px;
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-label {
            font-size: 16px;
            font-weight: bold;
        }

        .total-valor {
            font-size: 26px;
            font-weight: bold;
            color: #f2c94c;
        }

        /* ── BOTONES DE ACCIÓN ───────────────────────────────── */
        .acciones {
            margin-top: 15px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn-cobrar {
            background: #28a745;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
            width: 100%;
        }

        .btn-cobrar:hover {
            background: #1e7e34;
            transform: translateY(-1px);
        }

        .btn-cancelar {
            background: white;
            color: #dc3545;
            border: 2px solid #dc3545;
            padding: 12px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
            width: 100%;
        }

        .btn-cancelar:hover {
            background: #f8d7da;
        }

        .comanda-vacia {
            text-align: center;
            padding: 30px 20px;
            color: #aaa;
        }

        .comanda-vacia .icono {
            font-size: 40px;
            margin-bottom: 10px;
        }

        /* ── FOOTER ─────────────────────────────────────────── */
        footer {
            background: #244a73;
            color: white;
            text-align: center;
            padding: 18px;
            margin-top: 40px;
        }

        /* ── RESPONSIVE ─────────────────────────────────────── */
        @media (max-width: 768px) {
            main {
                grid-template-columns: 1fr;
            }

            .comanda-panel {
                position: static;
            }
        }
    </style>
</head>

<body>

    {{-- BARRA SUPERIOR --}}
    <div class="barra-top">
        <span>
            <a href="{{ route('empleado.mesas') }}">← Volver a Mesas</a>
            &nbsp;|&nbsp; 🧑‍🍳 <strong>{{ Auth::user()->name }}</strong>
        </span>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn-logout">Cerrar Sesión</button>
        </form>
    </div>

    {{-- HEADER --}}
    <header>
        <img src="{{ asset('imagenes/logo.png') }}" alt="Logo">
        <div>
            <h1>🍽️ Comanda – {{ $mesa->numero }}</h1>
            <p>Agrega los platos que pide la mesa y cobra cuando terminen</p>
        </div>
    </header>

    <main>

        {{-- ──────── COLUMNA IZQUIERDA: AGREGAR PLATO ──────── --}}
        <div>

            @if(session('success'))
                <div class="alerta alerta-exito">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alerta alerta-error">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            {{-- FORMULARIO AGREGAR --}}
            <div class="panel" style="margin-bottom: 20px;">
                <div class="panel-header">➕ Agregar plato a la comanda</div>
                <div class="panel-body">

                    <form
                        action="{{ route('empleado.agregar', $comanda->id) }}"
                        method="POST"
                        id="form-agregar"
                    >
                        @csrf

                        <div class="form-agregar">

                            <div class="campo-form">
                                <label for="producto_venta_id">Plato / Producto</label>
                                <select
                                    id="producto_venta_id"
                                    name="producto_venta_id"
                                    required
                                >
                                    <option value="">— Selecciona un plato —</option>
                                    @foreach($productos as $cat => $platos)
                                        <optgroup label="{{ $cat }}">
                                            @foreach($platos as $plato)
                                                <option value="{{ $plato->id }}">
                                                    {{ $plato->nombre }} — ${{ number_format($plato->precio, 2) }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <div class="campo-form" style="max-width: 100px;">
                                <label for="cantidad">Cantidad</label>
                                <input
                                    type="number"
                                    id="cantidad"
                                    name="cantidad"
                                    value="1"
                                    min="1"
                                    max="99"
                                    required
                                >
                            </div>

                            <button type="submit" class="btn-agregar">
                                ✅ Agregar
                            </button>

                        </div>

                    </form>

                </div>
            </div>

            {{-- CATÁLOGO VISUAL DE PLATOS --}}
            <div class="panel">
                <div class="panel-header">📋 Carta del Restaurante</div>
                <div class="panel-body">
                    @foreach($productos as $cat => $platos)
                        <div class="catalogo-cat">
                            <div class="catalogo-cat-titulo">{{ $cat }}</div>
                            <div class="catalogo-grid">
                                @foreach($platos as $plato)
                                    <div
                                        class="producto-btn"
                                        onclick="seleccionarProducto({{ $plato->id }}, '{{ addslashes($plato->nombre) }}')"
                                    >
                                        <div class="prod-nombre">{{ $plato->nombre }}</div>
                                        <div class="prod-precio">${{ number_format($plato->precio, 2) }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- ──────── COLUMNA DERECHA: COMANDA ACTIVA ─────── --}}
        <div class="comanda-panel">

            <div class="panel">
                <div class="panel-header">🧾 Comanda Actual</div>
                <div class="panel-body">

                    {{-- INFO DE LA MESA --}}
                    <div class="comanda-info">
                        <div class="info-item">
                            <div class="info-label">Mesa</div>
                            <div class="info-valor">{{ $mesa->numero }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Mesero</div>
                            <div class="info-valor">{{ $comanda->mesero ?? Auth::user()->name }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Items</div>
                            <div class="info-valor">{{ $comanda->detalles->count() }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Estado</div>
                            <div class="info-valor">{{ $comanda->estado }}</div>
                        </div>
                    </div>

                    {{-- LISTA DE ITEMS --}}
                    @if($comanda->detalles->isEmpty())
                        <div class="comanda-vacia">
                            <div class="icono">🍽️</div>
                            <p>La comanda está vacía.<br>Agrega los platos del pedido.</p>
                        </div>
                    @else
                        <ul class="items-lista">
                            @foreach($comanda->detalles as $item)
                                <li>
                                    <div>
                                        <div class="item-nombre">{{ $item->nombre_producto }}</div>
                                        <div class="item-cantidad">
                                            {{ $item->cantidad }} × ${{ number_format($item->precio_unitario, 2) }}
                                        </div>
                                    </div>
                                    <div style="display:flex; align-items:center; gap:8px;">
                                        <span class="item-subtotal">${{ number_format($item->subtotal, 2) }}</span>
                                        <form
                                            action="{{ route('empleado.quitar', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Quitar este ítem de la comanda?')"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-quitar" title="Eliminar">✕</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        {{-- TOTAL --}}
                        <div class="total-box">
                            <span class="total-label">💰 TOTAL</span>
                            <span class="total-valor">${{ number_format($comanda->total, 2) }}</span>
                        </div>

                        {{-- ACCIONES --}}
                        <div class="acciones">

                            {{-- COBRAR --}}
                            <form
                                action="{{ route('empleado.cobrar', $comanda->id) }}"
                                method="POST"
                                onsubmit="return confirm('¿Confirmar el cobro de ${{ number_format($comanda->total, 2) }}? La mesa quedará libre.')"
                            >
                                @csrf
                                <button type="submit" class="btn-cobrar">
                                    💳 Cobrar — ${{ number_format($comanda->total, 2) }}
                                </button>
                            </form>

                            {{-- CANCELAR --}}
                            <form
                                action="{{ route('empleado.cancelar', $comanda->id) }}"
                                method="POST"
                                onsubmit="return confirm('¿Cancelar esta comanda? La mesa quedará libre.')"
                            >
                                @csrf
                                <button type="submit" class="btn-cancelar">
                                    ❌ Cancelar comanda
                                </button>
                            </form>

                        </div>
                    @endif

                </div>
            </div>

        </div>

    </main>

    <footer>
        <p>Las Delicias de Mamá Ruby © 2026</p>
    </footer>

    <script>
        /**
         * Seleccionar un producto del catálogo visual
         * y rellenarlo en el select del formulario de agregar.
         */
        function seleccionarProducto(id, nombre) {
            const select = document.getElementById('producto_venta_id');
            select.value = id;

            // Marcar visualmente el producto seleccionado
            document.querySelectorAll('.producto-btn').forEach(btn => {
                btn.classList.remove('seleccionado');
            });
            event.currentTarget.classList.add('seleccionado');

            // Enfocar el campo de cantidad
            document.getElementById('cantidad').focus();
        }
    </script>

</body>
</html>
