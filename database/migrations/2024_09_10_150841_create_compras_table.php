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
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Referência ao usuário que fez a compra
            $table->foreignId('produto_id')->constrained()->onDelete('cascade'); // Referência ao produto comprado
            $table->decimal('valor_total', 10, 2); // Valor total da compra
            $table->integer('quantidade'); // Quantidade de produtos comprados
            $table->timestamp('data_compra'); // Data da compra
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
