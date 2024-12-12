<x-app-layout>
    <div class="container mx-auto p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">{{ $pessoa->nome }}</h1>

            <a href="{{ route('pessoas.create') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fa-solid fa-plus mr-2"></i> Listar
            </a>
        </div>

        <div class="bg-white shadow-md rounded p-6">
            <div class="mb-4">
                <span
                    class="font-bold text-gray-700">Data de Nascimento:</span>
                    {{ date('d/m/Y', strtotime($pessoa->dataNascimento)) }}
            </div>
            <div class="mb-4">
                <span class="font-bold text-gray-700">Gênero:</span> {{ $pessoa->genero }}
            </div>

            @if ($profissional)
                <div class="mt-6">
                    <h2 class="text-xl font-semibold mb-2">Dados do Profissional</h2>
                    <div class="border rounded p-4">
                        <div class="">
                            <span
                                class="font-bold text-gray-700">Nome Carimbo:</span> {{ $profissional->denominacao }}
                        </div>
                        <div class="">
                            <span
                                class="font-bold text-gray-700">Especialidade:</span> {{ $profissional->especialidade }}
                        </div>
                        <div class="mb-2">
                            <span class="font-bold text-gray-700">CRM:</span> {{ $profissional->registro }}
                        </div>
                    </div>
                </div>
            @endif

            @if ($paciente)
                <div class="mt-6">
                    <h2 class="text-xl font-semibold mb-2">Dados do Paciente</h2>
                    <div class="border rounded p-4">
                        <div class="">
                            <span
                                class="font-bold text-gray-700">Projeto:</span> {{ $paciente->grupo->projeto->denominacao }}
                        </div>
                        <div class="">
                            <span
                                class="font-bold text-gray-700">Grupo:</span> {{ $paciente->grupo->denominacao }}
                        </div>
                        <div class="">
                            <span
                                class="font-bold text-gray-700">Condição:</span> {{ $paciente->condicao->denominacao }}
                        </div>
                    </div>
                </div>
            @endif

            @if ($atendimentos_agrupados && $atendimentos_agrupados->count() > 0 )
                <div class="mt-6">
                    <h2 class="text-xl font-semibold mb-2">Atendimentos</h2>
                    <div class="border rounded p-4">
                        @foreach ($atendimentos_agrupados as $tipo_atendimento => $atendimentos)
                            <div>
                                <h3 class="font-bold bg-gray-200 p-2">{{ $tipo_atendimento->denominacao }}</h3>
                                <ul>
                                    @foreach ($atendimentos as $atendimento)
                                        <li class="py-4 px-6">
                                            {{ date('d/m/Y', strtotime($atendimento->dataAtendimento)) }} -
                                            {{$atendimento->profissional->denominacao}}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="flex gap-4 mt-6">
                <a href="{{ route('pessoas.edit', $pessoa->id) }}"
                   class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fa-solid fa-pencil mr-2"></i> Editar
                </a>
                <form action="{{ route('pessoas.destroy', $pessoa->id) }}" method="POST"
                      onsubmit="return confirm('Tem certeza que deseja excluir esta pessoa?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fa-solid fa-trash mr-2"></i> Excluir
                    </button>
                </form>
            </div>
        </div>

        <a href="{{ route('pessoas.index') }}"
           class="mt-6 inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
            <i class="fa-solid fa-arrow-left mr-2"></i> Voltar para a lista
        </a>
    </div>
</x-app-layout>
