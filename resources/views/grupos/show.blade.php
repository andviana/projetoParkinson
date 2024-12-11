<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Grupo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center m-6">
                    <h1 class="text-3xl font-bold"> Informações do Grupo </h1>

                    <a href="{{ route('grupos.index') }}" class="bg-gray-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Voltar
                    </a>
                </div>
                <div class="p-6 text-gray-900">
                    <p class="mb-2"><strong>Código:</strong> {{ $grupo->id }}</p>
                    <br/>

                    <p class="mb-2"><strong>Nome do grupo:</strong> {{ $grupo->denominacao }}</p>
                    <p class="mb-2"><strong>Projeto:</strong> {{ $grupo->projeto->denominacao }}</p>

                    <div class=" border rounded shadow-sm p-4 m-4">
                        <h2 class="text-xl">Pacientes do grupo:</h2>
                        <hr class="mb-2"/>

                        <ul>
                            @foreach ($pacientes_agrupados as $denominacao => $pacientes)
                                <div>
                                    <h3 class="font-bold bg-gray-200 p-2">{{ $denominacao }}</h3>
                                    <ul>
                                        @foreach ($pacientes as $paciente)
                                            <li class="py-4 px-6">{{ $paciente->pessoa->nome }} </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
