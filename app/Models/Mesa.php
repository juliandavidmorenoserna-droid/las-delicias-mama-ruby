<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    protected $table = 'mesas';

    protected $fillable = [
        'numero',
        'capacidad',
        'estado',
    ];

    public function pedidos()
    {
        return $this->hasMany(PedidoMesa::class, 'mesa_id');
    }

    public function comandaActiva()
    {
        return $this->hasOne(PedidoMesa::class, 'mesa_id')->where('estado', 'Abierta')->latest();
    }
}
