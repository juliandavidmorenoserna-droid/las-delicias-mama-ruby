<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mesas', function (Blueprint $table) {
            $table->id();
            $table->string('numero'); // Ej: "Mesa 1", "Mesa 2"
            $table->integer('capacidad')->default(4);
            $table->string('estado')->default('Libre'); // 'Libre', 'Ocupada'
            $table->timestamps();
        });

        Schema::create('pedidos_mesa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mesa_id')->constrained('mesas')->cascadeOnDelete();
            $table->string('mesero')->nullable();
            $table->string('estado')->default('Abierta'); // 'Abierta', 'Pagada', 'Cancelada'
            $table->decimal('total', 10, 2)->default(0);
            $table->text('notas')->nullable();
            $table->timestamps();
        });

        Schema::create('detalle_pedidos_mesa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_mesa_id')->constrained('pedidos_mesa')->cascadeOnDelete();
            $table->foreignId('producto_venta_id')->constrained('productos_venta')->cascadeOnDelete();
            $table->string('nombre_producto');
            $table->decimal('cantidad', 10, 2);
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_pedidos_mesa');
        Schema::dropIfExists('pedidos_mesa');
        Schema::dropIfExists('mesas');
    }
};
