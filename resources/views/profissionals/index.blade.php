<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Profissionais') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <a href="{{ route('profissionals.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        <i class="fa fa-plus mr-1"></i> Novo </a>

                    <div class="overflow-x-auto relative mt-6">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="uppercase bg-gray-50 ">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nome
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Especialidade
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Registro
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ações
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($profissionais as $profissional)
                                <tr>
                                    <td class="py-4 px-6">
                                        {{ $profissional->pessoa->nome }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $profissional->especialidade }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $profissional->registro }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <a href="{{ route('profissionals.show', $profissional->id) }}" title="mostrar" class="font-medium text-blue-600 dark:text-blue-500 hover:no-underline">
                                            <i class="fa-regular fa-file mx-2"></i>
                                        </a>
                                        <a href="{{ route('profissionals.edit', $profissional->id) }}" title="editar" class="font-medium text-indigo-600 dark:indigo-yellow-500 hover:no-underline">
                                            <i class="fas fa-edit mx-2"></i>
                                        </a>
                                        <form action="{{ route('profissionals.destroy', $profissional->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline" title="excluir" onclick="return confirm('Tem certeza que deseja excluir este profissional?')">
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
</x-app-layout>
