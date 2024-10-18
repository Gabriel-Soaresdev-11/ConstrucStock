<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Venda;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Compra;
use App\Models\Pagamento;
use App\Models\Produto;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Writer\Pdf as WriterPdf;

class DashboardController extends Controller
{
    public function index()
    {
        // Obter o valor total das vendas de hoje apenas do usuário autenticado
        $userId = Auth::id();
        $vendasHoje = Venda::where('user_id', $userId)
            ->whereDate('data_venda', Carbon::today())
            ->get();
        $valorVendasHoje = $vendasHoje->sum('valor_total');
        $quantidadeVendasHoje = $vendasHoje->count();

        // Obter o faturamento do mês apenas do usuário autenticado
        $faturamentoMes = Venda::where('user_id', $userId)
            ->whereMonth('data_venda', Carbon::now()->month)
            ->whereYear('data_venda', Carbon::now()->year)
            ->sum('valor_total');

        // Obter a quantidade total de todos os produtos juntos
        $quantidadeTotalProdutos = Produto::where('user_id', $userId)->sum('quantidade_estoque');

        // Retornar a view com os dados filtrados pelo usuário autenticado
        return view('dashboard', compact('valorVendasHoje', 'quantidadeVendasHoje', 'faturamentoMes', 'quantidadeTotalProdutos'));
    }

    // Método para gerar o PDF e Excel
    public function gerarRelatorio()
    {
        $userId = Auth::id();
        $inicioMes = Carbon::now()->startOfMonth();
        $fimMes = Carbon::now()->endOfMonth();

        // Obter os produtos, vendas, pagamentos, e categorias
        $produtos = Produto::where('user_id', $userId)->get();

        // Carregar as vendas com os clientes e suas vendas
        $vendas = Venda::with('cliente.vendas')
            ->where('user_id', $userId)
            ->whereBetween('data_venda', [$inicioMes, $fimMes])
            ->get();

        $pagamentos = Pagamento::where('user_id', $userId)->get();
        $clientes = Cliente::where('user_id', $userId)->get();
        $categorias = Categoria::where('user_id', $userId)->get();

        // Criar a planilha
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Definir os cabeçalhos da planilha
        $sheet->setCellValue('A1', 'Produto');
        $sheet->setCellValue('B1', 'Quantidade em Estoque');
        $sheet->setCellValue('C1', 'Preço de Compra');
        $sheet->setCellValue('D1', 'Valor Total em Estoque');
        $sheet->setCellValue('E1', 'Categoria');
        $sheet->setCellValue('F1', 'Venda');
        $sheet->setCellValue('G1', 'Quantidade Vendida');
        $sheet->setCellValue('H1', 'Valor Total Vendido');
        $sheet->setCellValue('I1', 'Data de Venda');
        $sheet->setCellValue('J1', 'Cliente');
        $sheet->setCellValue('K1', 'Telefone Cliente');
        $sheet->setCellValue('L1', 'Total Compras Cliente');
        $sheet->setCellValue('M1', 'Valor Pago');
        $sheet->setCellValue('N1', 'Data de Pagamento');
        $sheet->setCellValue('O1', 'Método de Pagamento');
        $sheet->setCellValue('P1', 'Status Pagamento');

        // Preencher os dados dos produtos
        $row = 2;
        foreach ($produtos as $produto) {
            $categoria = $produto->categoria ? $produto->categoria->nome : 'Sem Categoria';
            $valorTotalEstoque = $produto->quantidade_estoque * $produto->preco_compra;

            $sheet->setCellValue('A' . $row, $produto->nome);
            $sheet->setCellValue('B' . $row, $produto->quantidade_estoque);
            $sheet->setCellValue('C' . $row, 'R$ ' . number_format($produto->preco_compra, 2, ',', '.'));
            $sheet->setCellValue('D' . $row, 'R$ ' . number_format($valorTotalEstoque, 2, ',', '.'));
            $sheet->setCellValue('E' . $row, $categoria);

            $row++;
        }

        // Preencher os dados das vendas
        foreach ($vendas as $venda) {
            $produtoNome = $venda->produto ? $venda->produto->nome : 'Produto Não Encontrado';
            $cliente = $venda->cliente ? $venda->cliente->nome : 'Cliente Desconhecido';
            $telefoneCliente = $venda->cliente ? $venda->cliente->telefone : '-';
            $totalComprasCliente = $venda->cliente ? $venda->cliente->vendas->sum('valor_total') : 0;

            $sheet->setCellValue('F' . $row, $produtoNome);
            $sheet->setCellValue('G' . $row, $venda->quantidade);
            $sheet->setCellValue('H' . $row, 'R$ ' . number_format($venda->valor_total, 2, ',', '.'));
            $sheet->setCellValue('I' . $row, Carbon::parse($venda->data_venda)->format('d/m/Y'));
            $sheet->setCellValue('J' . $row, $cliente);
            $sheet->setCellValue('K' . $row, $telefoneCliente);
            $sheet->setCellValue('L' . $row, 'R$ ' . number_format($totalComprasCliente, 2, ',', '.'));

            // Preencher os dados dos pagamentos
            $pagamento = $pagamentos->where('venda_id', $venda->id)->first();
            if ($pagamento) {
                $sheet->setCellValue('M' . $row, 'R$ ' . number_format($pagamento->valor_pagamento, 2, ',', '.'));
                $sheet->setCellValue('N' . $row, Carbon::parse($pagamento->data_pagamento)->format('d/m/Y'));
                $sheet->setCellValue('O' . $row, $pagamento->metodo_pagamento);
                $sheet->setCellValue('P' . $row, $pagamento->status ? 'Pago' : 'Não Pago');
            } else {
                $sheet->setCellValue('M' . $row, '-');
                $sheet->setCellValue('N' . $row, '-');
                $sheet->setCellValue('O' . $row, '-');
                $sheet->setCellValue('P' . $row, '-');
            }

            $row++;
        }

        // Salvar a planilha Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = 'relatorio_mensal.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName); // Cria um arquivo temporário

        $writer->save($temp_file);

        // Retornar o arquivo para download
        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }
}
