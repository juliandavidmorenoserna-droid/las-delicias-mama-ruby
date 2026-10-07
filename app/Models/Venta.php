<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';

    protected $fillable = [
        'codigo',
        'fecha',
        'metodo_pago',
        'cliente',
        'total',
        'notas',
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'total' => 'decimal:2',
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'venta_id');
    }
}
