<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categorias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6">Categorias Cadastradas</h1>

                    <!-- Exibe mensagens de sucesso -->
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <a href="{{ route('categorias.create') }}" class="bg-green-500 text-white px-4 py-2 rounded shadow-sm hover:bg-green-700">Adicionar Categoria</a>

                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr>
                                <th class="text-left">ID</th>
                                <th class="text-left">Nome</th>
                                <th class="text-left">Descrição</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categorias as $categoria)
                            <tr>
                                <td class="py-2">{{$categoria->id}}</td>
                                <td class="py-2">{{ $categoria->nome }}</td>
                                <td class="py-2">{{ $categoria->descricao }}</td>
                                <td class="py-2 text-center">
                                    <div class="space-x-2">
                                        <a href="{{ route('categorias.show', $categoria->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow-sm hover:bg-blue-700">Ver</a>
                                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded shadow-sm hover:bg-yellow-700">Editar</a>
                                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded shadow-sm hover:bg-red-700">Excluir</button>
                                        </form>
                                    </div>
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
