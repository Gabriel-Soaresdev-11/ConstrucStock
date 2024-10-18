<!-- Incluir jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Incluir CSS do Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Incluir JS do Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Nova Venda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6">Registrar Nova Venda</h1>

                    <!-- Exibe mensagens de sucesso -->
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Exibe erros de validação -->
                    @if ($errors->any())
                        <div class="bg-red-100 text-red-800 p-4 rounded mb-6">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Formulário de registro de venda -->
                    <form id="vendaForm" action="{{ route('vendas.store') }}" method="POST">
                        @csrf

                        <div id="produtosContainer">
                            <!-- Primeira linha de produto -->
                            <div class="produto-group mb-4 flex space-x-4">
                                <div class="w-1/2">
                                    <label for="produto_id" class="block font-medium text-gray-700">Produto</label>
                                    <select name="produtos[0][produto_id]"
                                        class="produto-select w-full mt-1 border-gray-300 rounded-md shadow-sm"
                                        required>
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto->id }}" data-preco="{{ $produto->preco_venda }}"
                                                @if ($produto->quantidade_estoque == 0) disabled @endif>
                                                {{ $produto->nome }} - R$
                                                {{ number_format($produto->preco_venda, 2, ',', '.') }}
                                                @if ($produto->quantidade_estoque == 0)
                                                    (Esgotado)
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="w-1/4">
                                    <label for="quantidade" class="block font-medium text-gray-700">Quantidade</label>
                                    <input type="number" name="produtos[0][quantidade]"
                                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm" min="1"
                                        required>
                                </div>
                            </div>
                        </div>

                        <!-- Botão para adicionar mais produtos -->
                        <button type="button" id="addProdutoBtn"
                            class="mt-4 bg-blue-500 text-white px-4 py-2 rounded shadow-sm hover:bg-blue-700">Adicionar
                            Outro Produto</button>

                        <div class="mt-6">
                            <label for="cliente_id" class="block font-medium text-gray-700">Cliente (opcional)</label>
                            <select name="cliente_id" id="cliente_id"
                                class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                <option value="">Selecione um Cliente (se houver)</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-6">
                            <label for="status_pagamento" class="block font-medium text-gray-700">Pagamento
                                Feito?</label>
                            <select name="status_pagamento" id="status_pagamento"
                                class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                                <option value="1">Sim</option>
                                <option value="0">Não (Fiado)</option>
                            </select>
                        </div>

                        <!-- Campo para selecionar Método de Pagamento -->
                        <div class="mt-6">
                            <label for="metodo_pagamento" class="block font-medium text-gray-700">Método de Pagamento</label>
                            <select name="metodo_pagamento" id="metodo_pagamento"
                                class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                                <option value="Credito">Credito</option>
                                <option value="Debito">Debito</option>
                                <option value="PIX">PIX</option>
                                <option value="Dinheiro">Dinheiro</option>
                            </select>
                        </div>

                        <!-- Exibir o valor total da compra -->
                        <h3 class="mt-6 text-xl font-bold">Total: R$ <span id="totalCompra">0.00</span></h3>

                        <button type="submit"
                            class="mt-6 bg-green-500 text-white px-4 py-2 rounded shadow-sm hover:bg-green-700">Registrar
                            Venda</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para adicionar mais produtos e calcular o total -->
    <script>
        let contador = 1;

        // Função para calcular o total
        function calcularTotal() {
            let total = 0;

            // Iterar sobre todos os grupos de produtos
            document.querySelectorAll('.produto-group').forEach(function(group) {
                const selectProduto = group.querySelector('.produto-select');
                const quantidadeInput = group.querySelector('input[name*="quantidade"]');

                const precoProduto = selectProduto.options[selectProduto.selectedIndex].getAttribute('data-preco');
                const quantidade = quantidadeInput.value;

                if (precoProduto && quantidade) {
                    total += parseFloat(precoProduto) * parseInt(quantidade);
                }
            });

            // Atualizar o valor total na tela
            document.getElementById('totalCompra').innerText = total.toFixed(2);
        }

        // Adicionar escutadores de eventos aos selects de produto e inputs de quantidade
        document.addEventListener('input', function(event) {
            if (event.target.matches('.produto-select') || event.target.matches('input[name*="quantidade"]')) {
                calcularTotal();
            }
        });

        // Adicionar um novo grupo de produtos dinamicamente
        document.getElementById('addProdutoBtn').addEventListener('click', function() {
            const container = document.getElementById('produtosContainer');
            const newGroup = document.createElement('div');
            newGroup.classList.add('produto-group', 'mb-4', 'flex', 'space-x-4');
            newGroup.innerHTML = `
                <div class="w-1/2">
                    <label for="produto_id" class="block font-medium text-gray-700">Produto</label>
                    <select name="produtos[${contador}][produto_id]" class="produto-select w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                        @foreach ($produtos as $produto)
                            <option value="{{ $produto->id }}" data-preco="{{ $produto->preco_venda }}">
                                {{ $produto->nome }} - R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-1/4">
                    <label for="quantidade" class="block font-medium text-gray-700">Quantidade</label>
                    <input type="number" name="produtos[${contador}][quantidade]" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" min="1" required>
                </div>
            `;
            container.appendChild(newGroup);
            contador++;

            // Inicializar o Select2 no novo campo de seleção de produto
            $('.produto-select').select2();

            // Recalcular o total quando um novo produto é adicionado
            calcularTotal();
        });

        // Inicializar o Select2 nos selects de produtos
        $(document).ready(function() {
            $('.produto-select').select2();
        });
    </script>
</x-app-layout>
