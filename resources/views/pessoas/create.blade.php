<x-app-layout>
    <div class="container mx-auto p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Lista de Pessoas</h1>

            <a href="{{ route('pessoas.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fa-solid fa-plus mr-2"></i>Listar
            </a>
        </div>

        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form method="POST" action="{{ route('pessoas.store') }}">
                @csrf

                <!-- Nome -->
                <div class="mb-4">
                    <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                    <input
                        type="text"
                        name="nome"
                        id="nome"
                        value="{{ old('nome') }}"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    />
                    <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                </div>

                <!-- Data de Nascimento -->
                <div class="mb-4">
                    <label for="dataNascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                    <input
                        type="date"
                        name="dataNascimento"
                        id="dataNascimento"
                        value="{{ old('dataNascimento') }}"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    />
                    <x-input-error :messages="$errors->get('dataNascimento')" class="mt-2" />
                </div>

                <!-- Gênero -->
                <div class="mb-4">
                    <label for="genero" class="block text-sm font-medium text-gray-700">Gênero</label>
                    <select
                        name="genero"
                        id="genero"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    >
                        <option value="M" {{ old('genero') == 'M' ? 'selected' : '' }}>Masculino</option>
                        <option value="F" {{ old('genero') == 'F' ? 'selected' : '' }}>Feminino</option>
                    </select>
                    <x-input-error :messages="$errors->get('genero')" class="mt-2" />
                </div>

                <!-- Botão de Enviar -->
                <x-primary-button class="mt-4">{{ __('Cadastrar') }}</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
