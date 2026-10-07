<?php

namespace App\Http\Controllers;

use App\Models\DetallePedidoMesa;
use App\Models\Mesa;
use App\Models\PedidoMesa;
use App\Models\ProductoVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpleadoMesaController extends Controller
{
    /**
     * Listar todas las mesas con su estado actual.
     */
    public function index()
    {
        $mesas = Mesa::with('comandaActiva')->orderBy('numero')->get();

        return view('empleado.mesas.index', compact('mesas'));
    }

    /**
     * Ver la comanda activa de una mesa (o crear una nueva).
     */
    public function comanda(Mesa $mesa)
    {
        // Si la mesa está libre, crear una nueva comanda
        if ($mesa->estado === 'Libre') {
            $comanda = PedidoMesa::create([
                'mesa_id' => $mesa->id,
                'mesero'  => Auth::user()->name,
                'estado'  => 'Abierta',
                'total'   => 0,
            ]);

            // Marcar la mesa como ocupada
            $mesa->update(['estado' => 'Ocupada']);
        } else {
            // Recuperar la comanda abierta existente
            $comanda = $mesa->comandaActiva;

            if (!$comanda) {
                // Si no hay comanda abierta (caso raro), crear una
                $comanda = PedidoMesa::create([
                    'mesa_id' => $mesa->id,
                    'mesero'  => Auth::user()->name,
                    'estado'  => 'Abierta',
                    'total'   => 0,
                ]);
            }
        }

        // Cargar los detalles de la comanda
        $comanda->load('detalles');

        // Productos disponibles para agregar al pedido
        $productos = ProductoVenta::orderBy('categoria')->orderBy('nombre')->get()->groupBy('categoria');

        return view('empleado.mesas.comanda', compact('mesa', 'comanda', 'productos'));
    }

    /**
     * Agregar un producto a la comanda de la mesa.
     */
    public function agregarProducto(Request $request, PedidoMesa $comanda)
    {
        $datos = $request->validate([
            'producto_venta_id' => 'required|exists:productos_venta,id',
            'cantidad'          => 'required|numeric|min:1|max:99',
        ], [
            'producto_venta_id.required' => 'Selecciona un producto.',
            'producto_venta_id.exists'   => 'El producto seleccionado no existe.',
            'cantidad.required'          => 'La cantidad es obligatoria.',
            'cantidad.min'               => 'La cantidad mínima es 1.',
        ]);

        $producto = ProductoVenta::findOrFail($datos['producto_venta_id']);
        $cantidad = (float) $datos['cantidad'];
        $subtotal = $cantidad * $producto->precio;

        DetallePedidoMesa::create([
            'pedido_mesa_id'    => $comanda->id,
            'producto_venta_id' => $producto->id,
            'nombre_producto'   => $producto->nombre,
            'cantidad'          => $cantidad,
            'precio_unitario'   => $producto->precio,
            'subtotal'          => $subtotal,
        ]);

        // Recalcular el total de la comanda
        $nuevoTotal = $comanda->detalles()->sum('subtotal');
        $comanda->update(['total' => $nuevoTotal]);

        return redirect()->route('empleado.comanda', $comanda->mesa_id)
            ->with('success', '✅ ' . $producto->nombre . ' agregado a la comanda.');
    }

    /**
     * Eliminar un ítem de la comanda.
     */
    public function quitarProducto(DetallePedidoMesa $detalle)
    {
        $mesaId   = $detalle->comanda->mesa_id;
        $comanda  = $detalle->comanda;
        $nombreProducto = $detalle->nombre_producto;

        $detalle->delete();

        // Recalcular el total
        $nuevoTotal = $comanda->detalles()->sum('subtotal');
        $comanda->update(['total' => $nuevoTotal]);

        return redirect()->route('empleado.comanda', $mesaId)
            ->with('success', '🗑️ ' . $nombreProducto . ' eliminado de la comanda.');
    }

    /**
     * Cobrar la comanda (marcar como pagada y liberar la mesa).
     */
    public function cobrar(PedidoMesa $comanda)
    {
        $mesa = $comanda->mesa;

        // Marcar comanda como pagada
        $comanda->update(['estado' => 'Pagada']);

        // Liberar la mesa
        $mesa->update(['estado' => 'Libre']);

        return redirect()->route('empleado.mesas')
            ->with('success', '💳 ¡Mesa ' . $mesa->numero . ' cobrada! Total: $' . number_format($comanda->total, 2) . '. Mesa liberada.');
    }

    /**
     * Cancelar la comanda y liberar la mesa.
     */
    public function cancelar(PedidoMesa $comanda)
    {
        $mesa = $comanda->mesa;

        $comanda->update(['estado' => 'Cancelada']);
        $mesa->update(['estado' => 'Libre']);

        return redirect()->route('empleado.mesas')
            ->with('success', '❌ Comanda de la ' . $mesa->numero . ' cancelada. Mesa liberada.');
    }
}
