<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Mesa;
use App\Models\PedidoMesa;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CajaController extends Controller
{
    /**
     * Panel de Caja en Vivo para la Administradora:
     * Muestra todas las mesas con consumo activo, los platos pedidos y el total a cobrar.
     */
    public function index()
    {
        // Mesas con comanda activa (Abierta o Por Cobrar)
        $mesasConComanda = Mesa::whereHas('pedidos', function ($query) {
            $query->whereIn('estado', ['Abierta', 'Por Cobrar']);
        })
        ->with(['pedidos' => function ($query) {
            $query->whereIn('estado', ['Abierta', 'Por Cobrar'])->with('detalles');
        }])
        ->orderBy('numero')
        ->get();

        // Total pendiente por cobrar en el restaurante en este momento
        $totalPendiente = $mesasConComanda->sum(function ($mesa) {
            return $mesa->pedidos->first()?->total ?? 0;
        });

        // Cantidad de cuentas solicitadas listas para cobro
        $cuentasListas = $mesasConComanda->filter(function ($mesa) {
            return $mesa->pedidos->first()?->estado === 'Por Cobrar';
        })->count();

        return view('admin.caja.index', compact('mesasConComanda', 'totalPendiente', 'cuentasListas'));
    }

    /**
     * Procesar el cobro de una mesa por parte de la Administradora.
     * Registra la venta oficial, descuenta inventario si aplica,
     * marca la comanda como pagada y libera la mesa.
     */
    public function cobrarMesa(Request $request, PedidoMesa $comanda)
    {
        $request->validate([
            'metodo_pago' => 'required|string|max:100',
            'monto_recibido' => 'nullable|numeric|min:0',
            'cliente' => 'nullable|string|max:255',
            'notas' => 'nullable|string|max:1000',
        ], [
            'metodo_pago.required' => 'Debes seleccionar el método de pago.',
        ]);

        $mesa = $comanda->mesa;

        if ($comanda->detalles->isEmpty()) {
            return back()->with('error', '⛔ No se puede cobrar una mesa sin platos o productos en la comanda.');
        }

        try {
            $venta = DB::transaction(function () use ($request, $comanda, $mesa) {
                // 1. Generar código correlativo de venta
                $ultimoId = Venta::max('id') ?? 0;
                $codigoVenta = 'VTA-' . str_pad($ultimoId + 1, 5, '0', STR_PAD_LEFT);

                // 2. Crear el registro en ventas
                $clienteNombre = $request->cliente ?: "Mesa {$mesa->numero} (Atendida por: {$comanda->mesero})";

                $venta = Venta::create([
                    'codigo'      => $codigoVenta,
                    'fecha'       => now(),
                    'metodo_pago' => $request->metodo_pago,
                    'cliente'     => $clienteNombre,
                    'total'       => $comanda->total,
                    'notas'       => ($request->notas ? $request->notas . " | " : "") . "Comanda Mesa: {$mesa->numero}, Mesero: {$comanda->mesero}",
                ]);

                // 3. Crear el detalle de la venta y descontar inventario si tiene producto asociado
                foreach ($comanda->detalles as $detalle) {
                    $productoVenta = $detalle->productoVenta;

                    DetalleVenta::create([
                        'venta_id'          => $venta->id,
                        'producto_venta_id' => $detalle->producto_venta_id,
                        'nombre_producto'   => $detalle->nombre_producto,
                        'cantidad'          => $detalle->cantidad,
                        'precio_unitario'   => $detalle->precio_unitario,
                        'subtotal'          => $detalle->subtotal,
                    ]);

                    // Descontar inventario de insumos si existe relación
                    if ($productoVenta && $productoVenta->inventario) {
                        $productoVenta->inventario->decrement('cantidad', $detalle->cantidad);
                    }
                }

                // 4. Marcar la comanda como pagada
                $comanda->update([
                    'estado' => 'Pagada',
                    'notas'  => "Cobrada por administración. Venta: {$codigoVenta}",
                ]);

                // 5. Liberar la mesa
                $mesa->update(['estado' => 'Libre']);

                return $venta;
            });

            return redirect()->route('admin.caja.index')
                ->with('success', "💵 ¡Cobro exitoso! Mesa '{$mesa->numero}' cobrada por $" . number_format($venta->total, 2) . " ({$request->metodo_pago}). La mesa ahora está LIBRE. Venta registrada: {$venta->codigo}");

        } catch (\Exception $e) {
            return back()->with('error', 'Error al procesar el cobro: ' . $e->getMessage());
        }
    }
}
