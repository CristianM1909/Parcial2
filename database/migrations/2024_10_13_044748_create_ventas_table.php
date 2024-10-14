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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->String(column: "descripcion");
            $table->foreignId('products_id')//Siendo la primary key de categorias
            ->constrained('products')
            ->onDelete('cascade') //ELIMINAR EN CASCADA
            ->onUpdate('cascade');
            $table->foreignId('clientes_id')//Siendo la primary key de categorias
            ->constrained('clientes')
            ->onDelete('cascade') //ELIMINAR EN CASCADA
            ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
