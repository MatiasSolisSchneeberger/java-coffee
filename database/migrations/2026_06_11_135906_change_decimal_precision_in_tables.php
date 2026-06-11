<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->decimal('total', 15, 2)->change();
        });

        Schema::table('detalle_pedidos', function (Blueprint $table) {
            $table->decimal('precio_unitario', 15, 2)->change();
            $table->decimal('subtotal', 15, 2)->change();
        });

        Schema::table('productos', function (Blueprint $table) {
            $table->decimal('precio', 15, 2)->change();
            $table->decimal('oferta', 15, 2)->nullable()->change();
        });

        Schema::table('item_carritos', function (Blueprint $table) {
            $table->decimal('precio_unitario', 15, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('item_carritos', function (Blueprint $table) {
            $table->decimal('precio_unitario', 10, 2)->nullable()->change();
        });

        Schema::table('productos', function (Blueprint $table) {
            $table->decimal('precio', 10, 2)->change();
            $table->decimal('oferta', 10, 2)->nullable()->change();
        });

        Schema::table('detalle_pedidos', function (Blueprint $table) {
            $table->decimal('precio_unitario', 10, 2)->change();
            $table->decimal('subtotal', 10, 2)->change();
        });

        Schema::table('pedidos', function (Blueprint $table) {
            $table->decimal('total', 10, 2)->change();
        });
    }
};
