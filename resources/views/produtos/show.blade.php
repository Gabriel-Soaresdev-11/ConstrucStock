<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Produto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Detalhes do Produto</h1>
                    <ul>
                        <li><strong>Nome:</strong> {{ $produto->nome }}</li>
                        <li><strong>Descrição:</strong> {{ $produto->descricao }}</li>
                        <li><strong>Quantidade em Estoque:</strong> {{ $produto->quantidade_estoque }}</li>
                        <li><strong>Preço de Compra:</strong> R$ {{ number_format($produto->preco_compra, 2, ',', '.') }}</li>
                        <li><strong>Preço de Venda:</strong> R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</li>
                    </ul>
                    
                    <a href="{{ route('produtos.edit', $produto->id) }}">Editar Produto</a>
                    
                    
                    <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Excluir Produto</button>
                    </form>
                    
                    <a href="{{ route('produtos.index') }}">Voltar para Lista</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>