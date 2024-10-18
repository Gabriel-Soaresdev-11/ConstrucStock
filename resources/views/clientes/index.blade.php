<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6">Clientes Cadastrados</h1>

                    <!-- Exibe mensagens de sucesso -->
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <a href="{{ route('clientes.create') }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded shadow-sm hover:bg-blue-700 mb-6">Cadastrar Novo
                        Cliente</a>

                    @if ($clientes->isEmpty())
                        <p class="text-gray-500">Nenhum cliente cadastrado.</p>
                    @else
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-4 text-left">Nome</th>
                                    <th class="py-2 px-4 text-left">Telefone</th>
                                    <th class="py-2 px-4 text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $cliente->nome }}</td>
                                        <td class="border px-4 py-2">{{ $cliente->telefone }}</td>
                                        <td class="border px-4 py-2 text-center">
                                            <div class="space-x-2">
                                                <a href="{{ route('clientes.edit', $cliente->id) }}"
                                                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700">Editar</a>
                                                <form action="{{ route('clientes.destroy', $cliente->id) }}"
                                                    method="POST" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Excluir</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
