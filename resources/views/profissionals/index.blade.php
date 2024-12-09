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

                    <a href="{{ route('profissionals.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Novo Profissional</a>

                    <div class="overflow-x-auto relative mt-6">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Registro
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Denominação
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Pessoa
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Ações
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($profissionais as $profissional)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
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
                                        <a href="{{ route('profissionals.show', $profissional->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Visualizar</a>
                                        <a href="{{ route('profissionals.edit', $profissional->id) }}" class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline">Editar</a>
                                        <form action="{{ route('profissionals.destroy', $profissional->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline" onclick="return confirm('Tem certeza que deseja excluir este profissional?')">Excluir</button>
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
