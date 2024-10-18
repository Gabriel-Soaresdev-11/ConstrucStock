<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Valor de Vendas do Dia -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-700">Vendas do Dia</h3>
                        <p class="text-3xl font-semibold text-green-500">R$ {{ number_format($valorVendasHoje, 2, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Quantidade de Vendas do Dia -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-700">Quantidade de Vendas</h3>
                        <p class="text-3xl font-semibold text-blue-500">{{ $quantidadeVendasHoje }}</p>
                    </div>
                </div>

                <!-- Faturamento do Mês -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-700">Faturamento do Mês</h3>
                        <p class="text-3xl font-semibold text-purple-500">R$ {{ number_format($faturamentoMes, 2, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Quantidade Total de Produtos -->
                <div class="bg-red-500 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-700">Quantidade Total de Produtos</h3>
                        <p class="text-3xl font-semibold text-red-500">{{ $quantidadeTotalProdutos }}</p>
                    </div>
                </div>
            </div>
            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div> --}}

            <div class="py-12">
                <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
                    <h1>Produtos e categorias</h1>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 flex justify-between">
                            <a href="{{ route('produtos.create') }}" class="bg-green-500 text-white px-4 py-2 rounded shadow-sm hover:bg-green-700">Adicionar Produtos</a>
                            <a href="{{ route('categorias.create') }}" class="bg-green-500 text-white px-4 py-2 rounded shadow-sm hover:bg-green-700">Adicionar categorias</a>

                            <a href="{{route('produtos.index')}}" class="bg-gray-500 text-white px-4 py-2 rounded shadow-sm hover:bg-gray-700">Visualizar Produtos</a>
                            <a href="{{route('categorias.index')}}" class="bg-gray-500 text-white px-4 py-2 rounded shadow-sm hover:bg-gray-700">Visualizar Categorias</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-12">
                <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
                    <h1>Vendas</h1>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 flex justify-between">
                            <a href="{{ route('vendas.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow-sm hover:bg-blue-700">Registrar Nova venda</a>
                            <a href="{{ route('vendas.diarias') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow-sm hover:bg-blue-700">Visualizar Vendas Diárias</a>
                            <a href="{{ route('vendas.fiadas') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow-sm hover:bg-blue-700">Visualizar Vendas Fiadas</a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="py-12">
                <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
                    <h1>Clientes</h1>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 flex justify-between">
                            <a href="{{ route('clientes.create') }}" class="bg-purple-500 text-white px-4 py-2 rounded shadow-sm hover:bg-purple-700">Registrar Novo cliente</a>
                            <a href="{{ route('clientes.index') }}" class="bg-purple-500 text-white px-4 py-2 rounded shadow-sm hover:bg-purple-700">Visualizar Clientes</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-12">
                <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
                    <h1>Relatório</h1>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 flex justify-between">
                            <a href="{{ route('relatorio.excel') }}" class="mt-6 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg">
                                Baixar Relatório Mensal
                            </a>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>
</x-app-layout>
