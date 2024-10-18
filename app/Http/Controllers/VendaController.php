<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Compra;
use App\Models\Venda;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function create()
    {
        // $produtos = Produto::all();
        // $clientes = Cliente::all();
        // Filtra os produtos pelo user_id do usuário autenticado
        $produtos = Produto::where('user_id', Auth::id())->get();
        $clientes = Cliente::where('user_id', Auth::id())->get();

        return view('vendas.create', compact('produtos', 'clientes'));
    }

    public function store(Request $request)
    {
        // Valida os dados da venda
        $request->validate([
            'produtos' => 'required|array',
            'produtos.*.produto_id' => 'required|exists:produtos,id',
            'produtos.*.quantidade' => 'required|integer|min:1',
            'status_pagamento' => 'required|boolean',
            'cliente_id' => 'nullable|exists:clientes,id',
            'metodo_pagamento' => 'required|string',
        ]);

        $valorTotal = 0;

        // Processar cada produto e calcular o valor total
        foreach ($request->produtos as $produtoVenda) {
            $produto = Produto::findOrFail($produtoVenda['produto_id']);
            $quantidade = $produtoVenda['quantidade'];

            // Verificar se o produto está esgotado ou se a quantidade solicitada é maior que o estoque disponível
            if ($produto->quantidade_estoque <= 0) {
                return redirect()->back()->withErrors(['Produto "' . $produto->nome . '" está esgotado e não pode ser vendido.']);
            }

            if ($produto->quantidade_estoque < $quantidade) {
                return redirect()->back()->withErrors(['Estoque insuficiente para o produto "' . $produto->nome . '". Disponível: ' . $produto->quantidade_estoque]);
            }

            // Calcular o valor total da venda
            $valorTotal += $produto->preco_venda * $quantidade;

            // Atualiza o estoque
            $produto->decrement('quantidade_estoque', $quantidade);

            // Registra cada venda no banco de dados
            Venda::create([
                'produto_id' => $produtoVenda['produto_id'],
                'cliente_id' => $request->cliente_id,
                'quantidade' => $quantidade,
                'data_venda' => now(),
                'valor_total' => $produto->preco_venda * $quantidade,
                'status_pagamento' => $request->status_pagamento,
                'metodo_pagamento' => $request->metodo_pagamento,
                'user_id' => Auth::id(),
            ]);
        }

        // Redireciona com o valor total da compra
        return redirect()->route('vendas.create')->with('success', 'Venda registrada com sucesso! Valor total da compra: R$ ' . number_format($valorTotal, 2, ',', '.'));
    }


    public function vendasDiarias(Request $request)
    {
        $data = $request->input('data') ?? now()->format('Y-m-d');

        // Busca todas as vendas realizadas na data, apenas para o usuário autenticado
        $vendas = Venda::where('user_id', Auth::id())
            ->whereDate('data_venda', $data)
            ->get();

        return view('vendas.diarias', compact('vendas', 'data'));
    }


    // Lista todas as vendas que estão com status de "fiado" (não pagas)
    public function listarFiadas()
    {
        // Filtra as vendas fiadas apenas do usuário autenticado
        $vendasFiadas = Venda::where('user_id', Auth::id())
            ->where('status_pagamento', 0) // Status 0 significa "fiado"
            ->get();

        return view('vendas.fiadas', compact('vendasFiadas'));
    }


    // Atualiza o status de uma venda específica para "pago"
    public function marcarComoPago($id)
    {
        // Verifica se a venda pertence ao usuário autenticado
        $venda = Venda::where('user_id', Auth::id())->findOrFail($id);

        // Atualiza o status de pagamento para "pago"
        $venda->status_pagamento = 1; // 1 significa "pago"
        $venda->save();

        return redirect()->route('vendas.fiadas')->with('success', 'Venda marcada como paga com sucesso!');
    }

    public function registrarCompra($produto, $quantidade)
    {
        Compra::create([
            'user_id' => Auth::id(),
            'produto_id' => $produto->id,
            'valor_total' => $produto->preco_compra * $quantidade,
            'quantidade' => $quantidade,
            'data_compra' => now(),
        ]);
    }
}
