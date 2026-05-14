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
       Schema::create('producto_favoritos', function (Blueprint $table) {
        $table->id();
        // Relación con el usuario que marca el favorito
        $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
        
        // Relación con el producto marcado
        $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
        
        $table->timestamps();

        // Opcional: Evita que un usuario tenga el mismo producto repetido en favoritos
        $table->unique(['usuario_id', 'producto_id']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_favoritos');
    }
};
