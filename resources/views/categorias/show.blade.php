<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Categoria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Detalhes do Categoria</h1>
                    <ul>
                        <li><strong>Nome:</strong> {{ $categoria->nome }}</li>
                        <li><strong>Descrição:</strong> {{ $categoria->descricao }}</li>
                    </ul>
                    
                    <a href="{{ route('categorias.edit', $categoria->id) }}">Editar Categoria</a>
                    
                    
                    <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Excluir Produto</button>
                    </form>
                    
                    <a href="{{ route('categorias.index') }}">Voltar para Lista</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>