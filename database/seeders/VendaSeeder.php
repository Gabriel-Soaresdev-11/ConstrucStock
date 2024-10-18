<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Venda;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $clientes = Cliente::all();  // Pegar todos os clientes
        $produtos = Produto::all();  // Pegar todos os produtos
        
        // Verificar se há produtos e clientes antes de gerar vendas
        if ($clientes->isEmpty() || $produtos->isEmpty()) {
            throw new \Exception('Nenhum cliente ou produto encontrado. Execute os seeders de produtos e clientes primeiro.');
        }

        // Gerar 20 vendas aleatórias
        for ($i = 0; $i < 20; $i++) {
            $cliente = $clientes->random();  // Selecionar um cliente aleatório
            $produto = $produtos->random();  // Selecionar um produto aleatório
            $quantidade = rand(1, 5);        // Quantidade de produtos aleatórios
            $valorTotal = $produto->preco_venda * $quantidade;  // Valor total da venda

            // Status de pagamento aleatório (0 = Fiado, 1 = Pago)
            $statusPagamento = rand(0, 1);

            // Método de pagamento aleatório
            $metodosPagamento = ['Credito', 'Debito', 'PIX', 'Dinheiro'];
            $metodoPagamento = $metodosPagamento[array_rand($metodosPagamento)];

            // Criar a venda
            $venda = Venda::create([
                'produto_id' => $produto->id,
                'cliente_id' => $cliente->id,
                'user_id' => 1,  // Supondo que o usuário autenticado tenha o ID 1
                'quantidade' => $quantidade,
                'data_venda' => Carbon::now()->subDays(rand(0, 30)),  // Data aleatória nos últimos 30 dias
                'valor_total' => $valorTotal,
                'status_pagamento' => $statusPagamento,
                'metodo_pagamento' => $metodoPagamento,
            ]);

            // Se o pagamento estiver marcado como "pago", criar um registro no modelo Pagamento
            if ($statusPagamento == 1) {
                \App\Models\Pagamento::create([
                    'venda_id' => $venda->id,
                    'data_pagamento' => Carbon::now()->subDays(rand(0, 5)),  // Data de pagamento recente
                    'valor_pagamento' => $valorTotal,
                    'metodo_pagamento' => $metodoPagamento,
                    'status' => 1,  // Pago
                    'user_id' => 1, // Supondo que o usuário autenticado tenha o ID 1
                ]);
            }
        }
    }
}
