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
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id'); // Chave estrangeira para produto
            $table->foreignId('cliente_id')->nullable(); // Cliente (opcional)
            $table->foreignId('user_id');
            $table->integer('quantidade'); // Quantidade do produto vendido
            $table->date('data_venda'); // Data da venda
            $table->decimal('valor_total', 10, 2); // Valor total da venda
            $table->string('metodo_pagamento')->nullable();
            $table->boolean('status_pagamento')->default(false); // Pagamento feito ou não (fiado)
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
