<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produtos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-6">Lista de Produtos</h1>
                    <!-- Exibe mensagens de sucesso -->
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <a href="{{ route('produtos.create') }}" class="bg-green-500 text-white px-4 py-2 rounded shadow-sm hover:bg-green-700">Adicionar Produto</a>

                    <table class="table-auto w-full mt-4 border-collapse">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border">Nome</th>
                                <th class="px-4 py-2 border">Descrição</th>
                                <th class="px-4 py-2 border">Estoque</th>
                                <th class="px-4 py-2 border">Preço de Venda</th>
                                <th class="px-4 py-2 border">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produtos as $produto)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 border">{{ $produto->nome }}</td>
                                <td class="px-4 py-3 border">{{ $produto->descricao }}</td>
                                <td class="px-4 py-3 border">{{ $produto->quantidade_estoque }}</td>
                                <td class="px-4 py-3 border">R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</td>
                                <td class="px-4 py-3 border">
                                    <a href="{{ route('produtos.show', $produto->id) }}" class="text-blue-500 hover:underline mr-2">Ver</a>
                                    <a href="{{ route('produtos.edit', $produto->id) }}" class="text-yellow-500 hover:underline mr-2">Editar</a>
                                    <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
