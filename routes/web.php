<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/produtos', ProdutoController::class);
    Route::post('/produtos/import', [ProdutoController::class, 'import'])->name('produtos.import');
    Route::resource('/categorias', CategoriaController::class);
    
    // Rota para exibir o formulário de criação de vendas (GET)
    Route::get('/vendas/create', [VendaController::class, 'create'])->name('vendas.create');

    // Rota para registrar a venda (POST)
    Route::post('/vendas', [VendaController::class, 'store'])->name('vendas.store');

    // Rota para visualizar as vendas diárias (GET)
    Route::get('/vendas/diarias', [VendaController::class, 'vendasDiarias'])->name('vendas.diarias');

    // Rota para exibir todas as vendas com status "fiado" (não pagas)
    Route::get('/vendas/fiadas', [VendaController::class, 'listarFiadas'])->name('vendas.fiadas');

    // Rota para atualizar o status de uma venda específica
    Route::patch('/vendas/{id}/pagar', [VendaController::class, 'marcarComoPago'])->name('vendas.pagar');

    Route::resource('clientes', ClienteController::class);

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
    // gera um relatório mensal das despesas
    Route::get('/relatorio-mensal', [DashboardController::class, 'gerarRelatorio'])->name('relatorio.excel');


});

require __DIR__ . '/auth.php';
