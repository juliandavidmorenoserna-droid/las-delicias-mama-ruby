<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoVenta extends Model
{
    protected $table = 'productos_venta';

    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria',
        'precio',
        'disponible',
        'producto_id',
    ];

    protected $casts = [
        'disponible' => 'boolean',
        'precio' => 'decimal:2',
    ];

    /**
     * Relación con el insumo de inventario (opcional).
     */
    public function inventario()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
