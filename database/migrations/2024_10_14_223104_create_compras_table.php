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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            $table->foreignId('proveedors_id')
            ->constrained('proveedors')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('products_id')
            ->constrained('products')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->integer('cantidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
