<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetallePedidoMesa extends Model
{
    protected $table = 'detalle_pedidos_mesa';

    protected $fillable = [
        'pedido_mesa_id',
        'producto_venta_id',
        'nombre_producto',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    protected $casts = [
        'cantidad' => 'decimal:2',
        'precio_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function pedidoMesa()
    {
        return $this->belongsTo(PedidoMesa::class, 'pedido_mesa_id');
    }

    // Alias para facilitar el acceso desde el controller
    public function comanda()
    {
        return $this->belongsTo(PedidoMesa::class, 'pedido_mesa_id');
    }

    public function productoVenta()
    {
        return $this->belongsTo(ProductoVenta::class, 'producto_venta_id');
    }
}
