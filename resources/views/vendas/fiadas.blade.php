<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vendas Fiadas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6">Vendas Fiadas</h1>

                    <!-- Exibe mensagens de sucesso -->
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Verifica se existem vendas fiadas -->
                    @if($vendasFiadas->isEmpty())
                        <p class="text-gray-500">Nenhuma venda fiada no momento.</p>
                    @else
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-4 text-left">Produto</th>
                                    <th class="py-2 px-4 text-left">Cliente</th>
                                    <th class="py-2 px-4 text-left">Quantidade</th>
                                    <th class="py-2 px-4 text-left">Valor Total</th>
                                    <th class="py-2 px-4 text-left">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vendasFiadas as $venda)
                                <tr>
                                    <td class="border px-4 py-2">{{ $venda->produto->nome }}</td>
                                    <td class="border px-4 py-2">{{ $venda->cliente->nome ?? 'Cliente desconhecido' }}</td>
                                    <td class="border px-4 py-2">{{ $venda->quantidade }}</td>
                                    <td class="border px-4 py-2">R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</td>
                                    <td class="border px-4 py-2">
                                        <!-- Botão para marcar como pago -->
                                        <form action="{{ route('vendas.pagar', $venda->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">Marcar como Pago</button>
                                        </form>
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
