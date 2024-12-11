<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Projeto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center m-6">
                    <h1 class="text-3xl font-bold"> Informações do Projeto </h1>

                    <a href="{{ route('projetos.index') }}" class="bg-gray-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Voltar
                    </a>
                </div>
                <div class="p-6 text-gray-900">
                    <p class="mb-2"><strong>Código:</strong> {{ $projeto->id }}</p>
                    <p class="mb-2"><strong>Denominação:</strong> {{ $projeto->denominacao }}</p>
                    <br/>

                    <div class=" border rounded shadow-sm p-4 m-4">
                        <h2 class="text-xl">Grupos vinculados:</h2>
                        <hr class="mb-2"/>
                        @foreach ($projeto->grupos as $grupo)
                            <tr>
                                <td class="py-4 px-6">
                                    {{ $grupo->denominacao }}
                                </td>
                            </tr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
