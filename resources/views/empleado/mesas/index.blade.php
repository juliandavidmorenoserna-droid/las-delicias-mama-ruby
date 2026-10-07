<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesas - Las Delicias de Mamá Ruby</title>

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

        .barra-top span strong {
            color: #f2c94c;
        }

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
            padding: 20px 25px;
            color: white;
            display: flex;
            align-items: center;
            gap: 18px;
            border-bottom: 4px solid #f2c94c;
        }

        header img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: contain;
            background: white;
            padding: 5px;
        }

        header h1 {
            font-size: 22px;
            color: white;
        }

        header p {
            font-size: 14px;
            color: #b0c4e4;
            margin-top: 3px;
        }

        /* ── MAIN ───────────────────────────────────────────── */
        main {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
            flex: 1;
            width: 100%;
        }

        /* ── ALERTAS ────────────────────────────────────────── */
        .alerta {
            padding: 14px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-weight: bold;
            text-align: center;
        }

        .alerta-exito {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        /* ── TITULO SECCION ─────────────────────────────────── */
        .seccion-titulo {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .seccion-titulo h2 {
            font-size: 24px;
            color: #1e3c72;
        }

        .leyenda {
            display: flex;
            gap: 15px;
            font-size: 13px;
        }

        .leyenda-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
        }

        .dot-libre    { background: #28a745; }
        .dot-ocupada  { background: #dc3545; }

        /* ── GRID DE MESAS ──────────────────────────────────── */
        .mesas-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .mesa-card {
            background: white;
            border-radius: 15px;
            padding: 25px 20px;
            text-align: center;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
            border-top: 5px solid #ddd;
            transition: 0.25s;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .mesa-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }

        .mesa-libre {
            border-top-color: #28a745;
        }

        .mesa-ocupada {
            border-top-color: #dc3545;
        }

        .mesa-icono {
            font-size: 45px;
            margin-bottom: 10px;
        }

        .mesa-numero {
            font-size: 18px;
            font-weight: bold;
            color: #1a2b4a;
            margin-bottom: 5px;
        }

        .mesa-capacidad {
            font-size: 13px;
            color: #888;
            margin-bottom: 12px;
        }

        .mesa-estado {
            display: inline-block;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .estado-libre {
            background: #d4edda;
            color: #155724;
        }

        .estado-ocupada {
            background: #f8d7da;
            color: #721c24;
        }

        .mesa-mesero {
            margin-top: 8px;
            font-size: 12px;
            color: #888;
        }

        .mesa-total {
            margin-top: 5px;
            font-size: 15px;
            font-weight: bold;
            color: #dc3545;
        }

        /* ── SIN MESAS ──────────────────────────────────────── */
        .sin-mesas {
            text-align: center;
            padding: 80px 20px;
            color: #aaa;
        }

        .sin-mesas .icono { font-size: 64px; margin-bottom: 15px; }
        .sin-mesas h3 { font-size: 22px; margin-bottom: 8px; }

        /* ── FOOTER ─────────────────────────────────────────── */
        footer {
            background: #244a73;
            color: white;
            text-align: center;
            padding: 18px;
            margin-top: 40px;
        }

        @media (max-width: 600px) {
            .seccion-titulo { flex-direction: column; gap: 12px; }
            header { flex-direction: column; text-align: center; }
        }
    </style>
</head>

<body>

    {{-- BARRA SUPERIOR --}}
    <div class="barra-top">
        <span>🧑‍🍳 Panel de Empleado &nbsp;|&nbsp; <strong>{{ Auth::user()->name }}</strong></span>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn-logout">Cerrar Sesión</button>
        </form>
    </div>

    {{-- HEADER --}}
    <header>
        <img src="{{ asset('imagenes/logo.png') }}" alt="Las Delicias de Mamá Ruby">
        <div>
            <h1>🪑 Gestión de Mesas</h1>
            <p>Selecciona una mesa para ver su comanda o abrir una nueva</p>
        </div>
    </header>

    <main>

        @if(session('success'))
            <div class="alerta alerta-exito">{{ session('success') }}</div>
        @endif

        {{-- TITULO --}}
        <div class="seccion-titulo">
            <h2>Mesas del Restaurante</h2>
            <div class="leyenda">
                <div class="leyenda-item">
                    <span class="dot dot-libre"></span> Libre
                </div>
                <div class="leyenda-item">
                    <span class="dot dot-ocupada"></span> Ocupada
                </div>
            </div>
        </div>

        {{-- GRID DE MESAS --}}
        @if($mesas->isEmpty())
            <div class="sin-mesas">
                <div class="icono">🪑</div>
                <h3>No hay mesas registradas</h3>
                <p>El administrador debe registrar las mesas del restaurante.</p>
            </div>
        @else
            <div class="mesas-grid">
                @foreach($mesas as $mesa)
                    <a
                        href="{{ route('empleado.comanda', $mesa->id) }}"
                        class="mesa-card {{ $mesa->estado === 'Libre' ? 'mesa-libre' : 'mesa-ocupada' }}"
                    >
                        <div class="mesa-icono">
                            {{ $mesa->estado === 'Libre' ? '🪑' : '🍽️' }}
                        </div>

                        <div class="mesa-numero">{{ $mesa->numero }}</div>

                        <div class="mesa-capacidad">
                            👥 Capacidad: {{ $mesa->capacidad }} personas
                        </div>

                        <span class="mesa-estado {{ $mesa->estado === 'Libre' ? 'estado-libre' : 'estado-ocupada' }}">
                            {{ $mesa->estado }}
                        </span>

                        @if($mesa->estado === 'Ocupada' && $mesa->comandaActiva)
                            <div class="mesa-mesero">
                                🧑‍🍳 {{ $mesa->comandaActiva->mesero }}
                            </div>
                            <div class="mesa-total">
                                ${{ number_format($mesa->comandaActiva->total, 2) }}
                            </div>
                        @endif

                    </a>
                @endforeach
            </div>
        @endif

    </main>

    <footer>
        <p>Las Delicias de Mamá Ruby © 2026</p>
    </footer>

</body>
</html>
