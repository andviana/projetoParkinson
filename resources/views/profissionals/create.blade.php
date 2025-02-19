<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Profissional') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center m-6">
                    <h1 class="text-3xl font-bold"> Cadastro</h1>

                    <a href="{{ route('profissionals.index') }}" class="bg-gray-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Voltar
                    </a>
                </div>
                <div class="p-6 text-gray-900">
                    <form action="{{ route('profissionals.store') }}" method="POST">
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

                        <h2 class="text-gray-700 text-sm font-bold mb-2">Dados para carimbo:</h2>
                        <div class="border rounded py-2 px-5 mb-4">
                            <div class="mb-4">
                                <label for="denominacao" class="block text-gray-700 text-sm font-bold mb-2">Denominação:</label>
                                <input type="text" name="denominacao" id="denominacao"
                                       class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                       required>
                            </div>
                            <div class="mb-4">
                                <label for="especialidade" class="block text-gray-700 text-sm font-bold mb-2">Especialidade:</label>
                                <input type="text" name="especialidade" id="especialidade"
                                       class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                       required>
                            </div>
                            <div class="mb-4">
                                <label for="registro" class="block text-gray-700 text-sm font-bold mb-2">Registro:</label>
                                <input type="text" name="registro" id="registro"
                                       class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                       required>
                            </div>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white  font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cadastrar</button>
                        <button type="button" onclick="window.location.href='{{ route('profissionals.index') }}'" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
