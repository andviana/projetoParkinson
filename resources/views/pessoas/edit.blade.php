<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Pessoa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center m-6">
                    <h1 class="text-3xl font-bold"> Editar </h1>

                    <a href="{{ route('pessoas.index') }}" class="bg-gray-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Voltar
                    </a>
                </div>
                <div class="p-6 text-gray-900">
                    <form action="{{ route('pessoas.update', $pessoa->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Nome -->
                        <div class="mb-4">
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input
                                type="text"
                                name="nome"
                                id="nome"
                                value="{{ $pessoa->nome }}"
                                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            />
                            <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                        </div>
                        <!-- Data de Nascimento -->
                        <div class="mb-4">
                            <label for="dataNascimento" class="block text-gray-700 text-sm font-bold mb-2">Data de Nascimento:</label>
                            <input
                                type="date"
                                name="dataNascimento"
                                id="dataNascimento"
                                value="{{ $pessoa->dataNascimento }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                max="{{ now()->toDateString('Y-m-d') }}"
                                min="1900-01-01"
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
                                <option value="" {{ $pessoa->genero == '' ? 'selected' : '' }}>Selecione o gênero</option>
                                <option value="M" {{ $pessoa->genero == 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ $pessoa->genero == 'F' ? 'selected' : '' }}>Feminino</option>
                            </select>
                            <x-input-error :messages="$errors->get('genero')" class="mt-2" />
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Atualizar</button>
                        <button type="button" onclick="window.location.href='{{ route('pessoas.index') }}'" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
