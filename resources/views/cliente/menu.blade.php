<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú - Las Delicias de Mamá Ruby</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #fffaf2;
            color: #4b2418;
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

        .btn-logout:hover {
            background: #a32828;
        }

        /* ── HEADER ─────────────────────────────────────────── */
        header {
            background: linear-gradient(135deg, #f7b6d2, #f48fb1);
            padding: 25px 20px;
            text-align: center;
            border-bottom: 5px solid #d4a017;
        }

        header img {
            width: 120px;
            height: 120px;
            object-fit: contain;
            background-color: white;
            border-radius: 50%;
            padding: 8px;
            margin-bottom: 10px;
        }

        header h1 {
            font-size: 28px;
            color: #4a2c2a;
            margin-bottom: 5px;
        }

        header p {
            font-size: 15px;
            color: #244a73;
        }

        /* ── CONTENIDO ──────────────────────────────────────── */
        main {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
            flex: 1;
            width: 100%;
        }

        /* ── ALERTA ─────────────────────────────────────────── */
        .alerta-exito {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 14px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            text-align: center;
            font-weight: bold;
        }

        /* ── BIENVENIDA ─────────────────────────────────────── */
        .bienvenida-cliente {
            background: white;
            border-radius: 15px;
            padding: 25px 30px;
            margin-bottom: 30px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.09);
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .bienvenida-icono {
            font-size: 50px;
            flex-shrink: 0;
        }

        .bienvenida-texto h2 {
            color: #d14d72;
            font-size: 22px;
            margin-bottom: 6px;
        }

        .bienvenida-texto p {
            color: #666;
            font-size: 15px;
        }

        /* ── BUSCADOR Y FILTROS ─────────────────────────────── */
        .filtros {
            background: white;
            border-radius: 12px;
            padding: 20px 25px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            display: flex;
            gap: 15px;
            align-items: flex-end;
            flex-wrap: wrap;
        }

        .filtros .campo-filtro {
            flex: 1;
            min-width: 200px;
        }

        .filtros label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            font-weight: bold;
            color: #4b2418;
        }

        .filtros input,
        .filtros select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            transition: 0.2s;
        }

        .filtros input:focus,
        .filtros select:focus {
            outline: none;
            border-color: #d14d72;
            box-shadow: 0 0 0 3px rgba(209, 77, 114, 0.12);
        }

        .btn-buscar {
            background: #d14d72;
            color: white;
            border: none;
            padding: 10px 22px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
            white-space: nowrap;
        }

        .btn-buscar:hover {
            background: #b82b70;
        }

        .btn-limpiar {
            background: #f0f0f0;
            color: #555;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.2s;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-limpiar:hover {
            background: #e0e0e0;
        }

        /* ── CATEGORÍA TITULO ───────────────────────────────── */
        .categoria-titulo {
            font-size: 22px;
            color: #244a73;
            margin-bottom: 18px;
            padding-bottom: 10px;
            border-bottom: 3px solid #f48fb1;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* ── GRID DE PLATOS ─────────────────────────────────── */
        .platos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .plato-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 3px 12px rgba(0,0,0,0.09);
            border-top: 4px solid #f48fb1;
            transition: 0.25s;
        }

        .plato-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.13);
        }

        .plato-imagen {
            width: 100%;
            height: 160px;
            object-fit: cover;
            background: #fde8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
        }

        .plato-info {
            padding: 16px;
        }

        .plato-nombre {
            font-size: 17px;
            font-weight: bold;
            color: #4b2418;
            margin-bottom: 6px;
        }

        .plato-descripcion {
            font-size: 13px;
            color: #777;
            line-height: 1.5;
            margin-bottom: 12px;
            min-height: 38px;
        }

        .plato-precio {
            font-size: 22px;
            font-weight: bold;
            color: #d14d72;
        }

        .plato-precio span {
            font-size: 14px;
            color: #999;
            font-weight: normal;
        }

        .plato-badge {
            display: inline-block;
            font-size: 11px;
            padding: 3px 9px;
            border-radius: 20px;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .badge-disponible {
            background: #d4edda;
            color: #155724;
        }

        .badge-agotado {
            background: #f8d7da;
            color: #721c24;
        }

        /* ── SIN RESULTADOS ─────────────────────────────────── */
        .sin-resultados {
            text-align: center;
            padding: 60px 20px;
            color: #888;
        }

        .sin-resultados .icono {
            font-size: 60px;
            margin-bottom: 15px;
        }

        .sin-resultados h3 {
            font-size: 20px;
            margin-bottom: 8px;
        }

        /* ── FOOTER ─────────────────────────────────────────── */
        footer {
            background: #244a73;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }

        /* ── RESPONSIVE ─────────────────────────────────────── */
        @media (max-width: 600px) {
            .bienvenida-cliente {
                flex-direction: column;
                text-align: center;
            }

            .filtros {
                flex-direction: column;
            }

            header h1 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

    {{-- BARRA SUPERIOR --}}
    <div class="barra-top">
        <span>🍽️ Menú Digital &nbsp;|&nbsp; Conectado como: <strong>{{ Auth::user()->name }}</strong></span>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn-logout">Cerrar Sesión</button>
        </form>
    </div>

    {{-- HEADER --}}
    <header>
        <img src="{{ asset('imagenes/logo.png') }}" alt="Logo Las Delicias de Mamá Ruby">
        <h1>Las Delicias de Mamá Ruby</h1>
        <p>Nuestra carta del día — con cariño de siempre 🌸</p>
    </header>

    <main>

        @if(session('success'))
            <div class="alerta-exito">{{ session('success') }}</div>
        @endif

        {{-- BIENVENIDA --}}
        <div class="bienvenida-cliente">
            <div class="bienvenida-icono">🌟</div>
            <div class="bienvenida-texto">
                <h2>¡Hola, {{ Auth::user()->name }}!</h2>
                <p>Explora nuestra carta de platos, bebidas y postres. Todos preparados con ingredientes frescos y mucho amor.</p>
            </div>
        </div>

        {{-- FILTROS --}}
        <form action="{{ route('cliente.menu') }}" method="GET" class="filtros">

            <div class="campo-filtro">
                <label for="buscar">🔍 Buscar plato</label>
                <input
                    type="text"
                    id="buscar"
                    name="buscar"
                    value="{{ $buscar ?? '' }}"
                    placeholder="Nombre o descripción..."
                >
            </div>

            <div class="campo-filtro">
                <label for="categoria">📂 Categoría</label>
                <select id="categoria" name="categoria">
                    <option value="">Todas las categorías</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat }}" {{ ($categoriaSeleccionada ?? '') === $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-buscar">Buscar</button>

            @if(!empty($buscar) || !empty($categoriaSeleccionada))
                <a href="{{ route('cliente.menu') }}" class="btn-limpiar">Limpiar</a>
            @endif

        </form>

        {{-- PLATOS POR CATEGORÍA --}}
        @if($productos->isEmpty())
            <div class="sin-resultados">
                <div class="icono">🔎</div>
                <h3>No encontramos platos</h3>
                <p>Intenta con otra búsqueda o categoría.</p>
            </div>
        @else
            @foreach($productos as $categoria => $platos)

                <h2 class="categoria-titulo">
                    🍴 {{ $categoria ?: 'Sin categoría' }}
                </h2>

                <div class="platos-grid">
                    @foreach($platos as $plato)
                        <div class="plato-card">

                            {{-- Imagen o emoji --}}
                            @if($plato->imagen)
                                <img
                                    src="{{ asset('imagenes/productos/' . $plato->imagen) }}"
                                    alt="{{ $plato->nombre }}"
                                    class="plato-imagen"
                                    style="display:block;"
                                >
                            @else
                                <div class="plato-imagen">🍽️</div>
                            @endif

                            <div class="plato-info">

                                {{-- Disponibilidad --}}
                                @if(isset($plato->disponible) && !$plato->disponible)
                                    <span class="plato-badge badge-agotado">Agotado</span>
                                @else
                                    <span class="plato-badge badge-disponible">Disponible</span>
                                @endif

                                <div class="plato-nombre">{{ $plato->nombre }}</div>

                                <div class="plato-descripcion">
                                    {{ $plato->descripcion ?? 'Preparado con ingredientes frescos.' }}
                                </div>

                                <div class="plato-precio">
                                    ${{ number_format($plato->precio, 2) }}
                                    <span>COP</span>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

            @endforeach
        @endif

    </main>

    <footer>
        <p>Las Delicias de Mamá Ruby © 2026 &nbsp;·&nbsp; ¡Buen provecho! 🥘</p>
    </footer>

</body>
</html>
