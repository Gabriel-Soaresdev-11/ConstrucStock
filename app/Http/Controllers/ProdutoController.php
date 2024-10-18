<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Auth;


class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $produtos = Produto::all();
        // Filtra os produtos pelo user_id do usuário autenticado
        $produtos = Produto::where('user_id', Auth::id())->get();

        return view('produtos.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all(); // Obtém todas as categorias do banco de dados
        return view('produtos.create', compact('categorias')); // Passa as categorias para a view
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos campos
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'quantidade_estoque' => 'required|integer|min:0',
            'preco_compra' => 'required|numeric|min:0',
            'preco_venda' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        // Criação do produto e atribuição automática do user_id
        Produto::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'quantidade_estoque' => $request->quantidade_estoque,
            'preco_compra' => $request->preco_compra,
            'preco_venda' => $request->preco_venda,
            'categoria_id' => $request->categoria_id,
            'user_id' => Auth::id(),  // Adiciona o user_id automaticamente
        ]);

        // Redireciona de volta com uma mensagem de sucesso
        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produto = Produto::find($id);

        return view('produtos.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    // Buscar o produto pelo ID e verificar se pertence ao usuário autenticado
    $produto = Produto::where('user_id', Auth::id())->find($id);

    // Se o produto não for encontrado, redirecionar de volta com uma mensagem de erro
    if (!$produto) {
        return redirect()->back()->with('error', 'Você não tem permissão para acessar este produto.');
    }

    // Buscar todas as categorias disponíveis
    $categorias = Categoria::all();

    // Retornar a view 'produtos.edit' com o produto e as categorias
    return view('produtos.edit', compact('produto', 'categorias'));
}



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'quantidade_estoque' => 'required|integer',
            'preco_compra' => 'required|numeric',
            'preco_venda' => 'required|numeric',
        ]);

        // Atualixa o produto
        $produto = Produto::find($id);
        $produto->update($request->all());

        return redirect()->route('produtos.index')->with('success', 'Produto atulizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produto = Produto::find($id);
        $produto->delete();

        return redirect()->route('produtos.index')->with('success', 'Produto excluido com sucesso');
    }

    // Função para importar produtos via Excel
    public function import(Request $request)
    {
        // Verifica se o usuário está autenticado usando o Facade Auth
        if (!Auth::check()) {
            return redirect()->back()->withErrors('Usuário não autenticado.');
        }

        // Obtém o ID do usuário autenticado
        $userId = Auth::id();

        // Valida o arquivo para garantir que seja um Excel válido
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Pega o caminho do arquivo carregado
        $file = $request->file('file')->getRealPath();

        // Usa o PhpSpreadsheet para carregar o arquivo Excel
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();

        // Pega as linhas da planilha
        $rows = $sheet->toArray();

        // Itera sobre as linhas da planilha
        foreach ($rows as $key => $row) {
            // Pula a primeira linha (cabeçalho)
            if ($key == 0) {
                continue;
            }

            // Cria um novo produto baseado nas colunas do Excel e atribui o user_id do usuário autenticado
            Produto::create([
                'nome' => $row[0], // Coluna 1: Nome do produto
                'descricao' => $row[1], // Coluna 2: Descrição
                'quantidade_estoque' => $row[2], // Coluna 3: Quantidade em estoque
                'preco_compra' => $row[3], // Coluna 4: Preço de compra
                'preco_venda' => $row[4], // Coluna 5: Preço de venda
                'categoria_id' => $row[5], // Coluna 6: Categoria (ID da categoria)
                'user_id' => $userId, // Atribui o user_id do usuário autenticado
            ]);
        }

        // Redireciona de volta com uma mensagem de sucesso
        return redirect()->route('produtos.index')->with('success', 'Produtos importados com sucesso!');
    }
}
