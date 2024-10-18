<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vendas do Dia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Vendas do Dia: {{ $data }}</h1>

                    @if($vendas->isEmpty())
                        <p>Não houve vendas neste dia.</p>
                    @else
                        <table class="table-auto w-full mt-4">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Produto</th>
                                    <th class="px-4 py-2">Cliente</th>
                                    <th class="px-4 py-2">Quantidade</th>
                                    <th class="px-4 py-2">Valor Total</th>
                                    <th class="px-4 py-2">Pagamento</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vendas as $venda)
                                <tr>
                                    <td class="border px-4 py-2">{{ $venda->produto->nome }}</td>
                                    <td class="border px-4 py-2">{{ $venda->cliente->nome ?? 'Cliente desconhecido' }}</td>
                                    <td class="border px-4 py-2">{{ $venda->quantidade }}</td>
                                    <td class="border px-4 py-2">R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</td>
                                    <td class="border px-4 py-2">{{ $venda->status_pagamento ? 'Pago' : 'Fiado' }}</td>
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
