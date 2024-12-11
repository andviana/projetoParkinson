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
                        <div class="mb-4">
                            <label for="pessoa_id" class="block text-gray-700 text-sm font-bold mb-2">Pessoa:</label>
                            <div class="flex items-center justify-between">
                            <select name="pessoa_id" id="pessoa_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                @foreach ($pessoas as $pessoa)
                                    <option value="{{ $pessoa->id }}">{{ $pessoa->nome }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2" data-modal-toggle="pessoa-modal">
                                <i class="fa fa-user-plus"></i>
                            </button>
                            </div>
                        </div>
                        <h2 class="text-gray-700 text-sm font-bold mb-2">Dados para carimbo:</h2>
                        <div class="border rounded py-2 px-5 mb-4">
                            <div class="mb-4">
                                <label for="denominacao" class="block text-gray-700 text-sm font-bold mb-2">Denominação:</label>
                                <input type="text" name="denominacao" id="denominacao" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>
                            <div class="mb-4">
                                <label for="especialidade" class="block text-gray-700 text-sm font-bold mb-2">Especialidade:</label>
                                <input type="text" name="especialidade" id="especialidade" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>
                            <div class="mb-4">
                                <label for="registro" class="block text-gray-700 text-sm font-bold mb-2">Registro:</label>
                                <input type="text" name="registro" id="registro" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white  font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cadastrar</button>
                        <button type="button" onclick="window.location.href='{{ route('profissionals.index') }}'" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>

                    </form>
                </div>
            </div>
        </div>

        {{--modal de cadastrro de pessoa--}}
        <div id="pessoa-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Cadastro de Pessoa
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="pessoa-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Fechar modal</span>
                        </button>
                    </div>
                    <form action="{{ route('pessoas.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="modal_origin" id="modal_origin" value="v_profissional">
                        <div class="px-4 py-4 bg-gray-200">
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
                        </div>
                        <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                            <button data-modal-toggle="pessoa-modal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Salvar</button>
                            <button data-modal-toggle="pessoa-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</x-app-layout>
