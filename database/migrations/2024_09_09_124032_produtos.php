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
        
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao');
            $table->foreignId('user_id');
            $table->integer('quantidade_estoque');
            $table->decimal('preco_compra', 8, 2);
            $table->decimal('preco_venda', 8, 2);
            $table->foreignId('categoria_id'); // chave estrangeira
            $table->timestamps();
        });
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('produtos');
    }
};
