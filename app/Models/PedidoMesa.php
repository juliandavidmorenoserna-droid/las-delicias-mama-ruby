<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoMesa extends Model
{
    protected $table = 'pedidos_mesa';

    protected $fillable = [
        'mesa_id',
        'mesero',
        'estado',
        'total',
        'notas',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    public function mesa()
    {
        return $this->belongsTo(Mesa::class, 'mesa_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedidoMesa::class, 'pedido_mesa_id');
    }
}
