<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\ProductoVenta;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    /**
     * Mostrar listado de ventas.
     */
    public function index(Request $request)
    {
        $buscar = $request->query('buscar');
        $fecha = $request->query('fecha');

        $query = Venta::with('detalles')->latest('fecha');

        if (!empty($buscar)) {
            $query->where(function ($q) use ($buscar) {
                $q->where('codigo', 'like', "%{$buscar}%")
                  ->orWhere('cliente', 'like', "%{$buscar}%");
            });
        }

        if (!empty($fecha)) {
            $query->whereDate('fecha', $fecha);
        }

        $ventas = $query->paginate(15);

        return view('ventas.index', compact('ventas', 'buscar', 'fecha'));
    }

    /**
     * Mostrar formulario para registrar una nueva venta.
     */
    public function create()
    {
        $productos = ProductoVenta::with('inventario')
            ->where('disponible', true)
            ->orderBy('nombre')
            ->get();

        return view('ventas.crear', compact('productos'));
    }

    /**
     * Registrar una venta y descontar stock automáticamente.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'metodo_pago' => 'required|string|max:100',
            'cliente' => 'nullable|string|max:255',
            'notas' => 'nullable|string|max:1000',
            'productos' => 'required|array|min:1',
            'productos.*.id' => 'required|exists:productos_venta,id',
            'productos.*.cantidad' => 'required|numeric|min:0.01',
        ], [
            'productos.required' => 'Debe agregar al menos un producto a la venta.',
            'productos.min' => 'Debe agregar al menos un producto a la venta.',
        ]);

        try {
            $venta = DB::transaction(function () use ($request) {
                $items = $request->input('productos');
                $totalVenta = 0;
                $detallesParaCrear = [];

                // 1. Validar stock de todos los productos primero
                foreach ($items as $item) {
                    $productoVenta = ProductoVenta::with('inventario')->findOrFail($item['id']);
                    $cantidad = (float) $item['cantidad'];

                    if ($productoVenta->inventario) {
                        $stockDisponible = (float) $productoVenta->inventario->cantidad;
                        if ($stockDisponible < $cantidad) {
                            throw new \Exception("Stock insuficiente para '{$productoVenta->nombre}'. Disponible en inventario: {$stockDisponible} {$productoVenta->inventario->unidad}, solicitado: {$cantidad}.");
                        }
                    }

                    $subtotal = $cantidad * (float) $productoVenta->precio;
                    $totalVenta += $subtotal;

                    $detallesParaCrear[] = [
                        'productoVenta' => $productoVenta,
                        'cantidad' => $cantidad,
                        'precio_unitario' => (float) $productoVenta->precio,
                        'subtotal' => $subtotal,
                    ];
                }

                // 2. Generar código único de venta
                $ultimoId = Venta::max('id') ?? 0;
                $codigo = 'VTA-' . str_pad($ultimoId + 1, 5, '0', STR_PAD_LEFT);

                // 3. Crear la venta
                $nuevaVenta = Venta::create([
                    'codigo' => $codigo,
                    'fecha' => $request->fecha,
                    'metodo_pago' => $request->metodo_pago,
                    'cliente' => $request->cliente ?: 'Cliente General',
                    'total' => $totalVenta,
                    'notas' => $request->notas,
                ]);

                // 4. Crear detalles y descontar stock del inventario
                foreach ($detallesParaCrear as $detalle) {
                    DetalleVenta::create([
                        'venta_id' => $nuevaVenta->id,
                        'producto_venta_id' => $detalle['productoVenta']->id,
                        'nombre_producto' => $detalle['productoVenta']->nombre,
                        'cantidad' => $detalle['cantidad'],
                        'precio_unitario' => $detalle['precio_unitario'],
                        'subtotal' => $detalle['subtotal'],
                    ]);

                    if ($detalle['productoVenta']->inventario) {
                        $detalle['productoVenta']->inventario->decrement('cantidad', $detalle['cantidad']);
                    }
                }

                return $nuevaVenta;
            });

            return redirect()->route('ventas.ver', $venta)
                ->with('success', 'Venta registrada con éxito. Se descontó el inventario automáticamente.');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Ver resumen y comprobante de una venta.
     */
    public function show(Venta $venta)
    {
        $venta->load('detalles');

        return view('ventas.ver', compact('venta'));
    }

    /**
     * Eliminar venta y revertir inventario.
     */
    public function destroy(Venta $venta)
    {
        DB::transaction(function () use ($venta) {
            $venta->load('detalles.productoVenta.inventario');

            foreach ($venta->detalles as $detalle) {
                if ($detalle->productoVenta && $detalle->productoVenta->inventario) {
                    $detalle->productoVenta->inventario->increment('cantidad', $detalle->cantidad);
                }
            }

            $venta->delete();
        });

        return redirect()->route('ventas.index')
            ->with('success', 'Venta eliminada y el stock fue devuelto al inventario.');
    }
}
