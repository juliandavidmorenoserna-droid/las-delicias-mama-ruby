<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';

    protected $fillable = [
        'nombre',
        'documento',
        'telefono',
        'cargo',
        'salario',
        'fecha_ingreso',
        'estado',
    ];

    protected $casts = [
        'salario' => 'decimal:2',
        'fecha_ingreso' => 'date',
    ];

    /**
     * Pagos realizados al empleado.
     */
    public function pagos()
    {
        return $this->hasMany(Pago::class, 'empleado_id');
    }
}
