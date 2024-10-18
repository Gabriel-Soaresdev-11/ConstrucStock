<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6">Cadastrar Novo Cliente</h1>

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

                    <form action="{{ route('clientes.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nome" class="block font-medium text-gray-700">Nome</label>
                            <input type="text" name="nome" id="nome" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="telefone" class="block font-medium text-gray-700">Telefone</label>
                            <input type="text" name="telefone" id="telefone" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                        </div>
                      
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded shadow-sm hover:bg-green-700">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{asset('/js/format_tel.js')}}"></script>
</x-app-layout>
