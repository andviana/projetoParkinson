
<x-app-layout>
    <div class="container mx-auto p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Lista de Pessoas</h1>

            <a href="{{ route('pessoas.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fa-plus mr-2"></i> Cadastro
            </a>
        </div>

        <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nome
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Data de Nascimento
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Gênero
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Ações</span>
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($pessoas as $pessoa)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $pessoa->nome }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
{{--                            <div class="text-sm text-gray-500">{{ $pessoa->dataNascimento->format('d/m/Y') }}</div>--}}
                            <div class="text-sm text-gray-500">{{ date('d/m/Y', strtotime($pessoa->dataNascimento)) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $pessoa->genero }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('pessoas.show', $pessoa->id) }}" class="text-blue-600 hover:text-blue-900 mr-4">
                                <i class="fa-solid fa-eye"></i> Mostrar
                            </a>
                            <a href="{{ route('pessoas.edit', $pessoa->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">
                                <i class="fa-solid fa-pencil"></i> Editar
                            </a>
                            <a href="#" class="text-green-600 hover:text-green-900">
                                <i class="fa-solid fa-phone"></i> Atender
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>


