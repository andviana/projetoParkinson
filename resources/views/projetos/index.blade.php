<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Projetos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <a href="{{ route('projetos.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        <i class="fa fa-plus mr-1"></i> Novo </a>

                    <div class="overflow-x-auto relative mt-6">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="uppercase bg-gray-50 ">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Denominação
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Grupos
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ações
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($projetos as $projeto)
                                <tr>
                                    <td class="py-4 px-6">
                                        {{ $projeto->denominacao }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <ul>
                                            @foreach ($projeto->grupos as $grupo)
                                                <a href="{{ route('grupos.show', $grupo->id) }}" title="mostrar" class="">
                                                <li class="border rounded m-2 border-blue-400 text-blue-400 text-center hover:bg-blue-400 hover:text-white hover:no-underline shadow-sm">

                                                        {{ $grupo->denominacao }}
                                                </li>
                                                </a>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="py-4 px-6">
                                        <a href="{{ route('projetos.show', $projeto->id) }}" title="mostrar" class="font-medium text-blue-600 dark:text-blue-500 hover:no-underline">
                                            <i class="fa-regular fa-file mx-2"></i>
                                        </a>
                                        <a href="{{ route('projetos.edit', $projeto->id) }}" title="editar" class="font-medium text-indigo-600 dark:indigo-yellow-500 hover:no-underline">
                                            <i class="fas fa-edit mx-2"></i>
                                        </a>
                                        <button type="button" class="font-medium text-green-600 dark:indigo-yellow-500" data-modal-toggle="grupo-modal">
                                            <i class="fa fa-users"></i>
                                        </button>
                                        <form action="{{ route('projetos.destroy', $projeto->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline" title="excluir" onclick="return confirm('Tem certeza que deseja excluir este projeto?')">
                                                <i class="fa-solid fa-xmark mx-2"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{--modal de cadastrro de grupos--}}
    <div id="grupo-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Cadastro de Pessoa
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="grupo-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Fechar modal</span>
                    </button>
                </div>
                <form action="{{ route('grupos.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="modal_origin" id="modal_origin" value="v_projeto">
                    <input type="hidden" name="projeto_id" id="projeto_id" value="{{$projeto->id}}">
                    <div class="px-4 py-4 bg-gray-200">
                        <!-- denominacao -->
                        <div class="mb-4">
                            <label for="denominacao" class="block text-sm font-medium text-gray-700">Denominação</label>
                            <input
                                type="text"
                                name="denominacao"
                                id="denominacao"
                                value="{{ old('denominacao') }}"
                                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            />
                            <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                        <button data-modal-toggle="grupo-modal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Salvar</button>
                        <button data-modal-toggle="grupo-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
