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
                    <h1 class="text-3xl font-bold"> Editar Paciente </h1>

                    <a href="{{ route('pacientes.index') }}" class="bg-gray-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Voltar
                    </a>
                </div>

                <div class="p-6 text-gray-900">
                    <form action="{{ route('pacientes.update', $paciente->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4 border  rounded  p-4 border-blue-200 border-l-4">
                            <span class="text-2xl font-semibold text-gray-600"> <i class="fas fa-user mr-2 text-gray-200"></i>{{ $paciente->pessoa->nome }}</span>
                        </div>
                        <h2 class="text-gray-700 text-sm font-bold mb-2">Dados do Paciente:</h2>
                        <div class="border rounded py-2 px-5 mb-4">
                            <div class="mb-4">
                                <label for="condicao_id" class="block text-gray-700 text-sm font-bold mb-2">Condição:</label>
                                <div class="flex items-center justify-between">
                                    <select name="condicao_id" id="condicao_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                        <option value="0" {{ $paciente->condicao == '' ? 'selected' : '' }} >Selecione a condição</option>
                                        @foreach ($condicaos as $condicao)
                                            <option value="{{ $condicao->id }}" {{ $paciente->condicao == $condicao ? 'selected' : '' }} >{{ $condicao->denominacao }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2" data-modal-toggle="condicao-modal">
                                        <i class="fa-solid fa-heart-circle-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="grupo_id" class="block text-gray-700 text-sm font-bold mb-2">Grupo:</label>
                                <div class="flex items-center justify-between">
                                    <select name="grupo_id" id="grupo_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                        <option value="0" {{ $paciente->grupo == '' ? 'selected' : '' }}>Selecione o grupo</option>
                                        @foreach ($grupos as $grupo)
                                            <option value="{{ $grupo->id }}" {{ $paciente->grupo == $grupo ? 'selected' : '' }} >{{$grupo->projeto->denominacao}}&nbsp;-&nbsp;{{ $grupo->denominacao }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2" data-modal-toggle="grupo-modal">
                                        <i class="fa-solid fa-users"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white  font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Atualizar</button>
                        <button type="button" onclick="window.location.href='{{ route('pacientes.index') }}'" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>










