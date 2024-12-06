<x-app-layout>
    <div class="container mx-auto p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Dados da Pessoa</h1>

            <a href="{{ route('pessoas.create') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fa-solid fa-plus mr-2"></i> Listar
            </a>
        </div>
        {{--        <x-alert type="success" message="{{ session('success') }}" />--}}
        <div class="bg-white shadow-md rounded p-6">
            <div class="mb-4">
                <span class="font-bold text-gray-700">Nome:</span> {{ $pessoa->nome }}
            </div>
            <div class="mb-4">
                <span
                    class="font-bold text-gray-700">Data de Nascimento:</span>
{{--                {{ $pessoa->dataNascimento->format('d/m/Y') }}--}}
                {{ date('d/m/Y', strtotime($pessoa->dataNascimento)) }}
            </div>
            <div class="mb-4">
                <span class="font-bold text-gray-700">Gênero:</span> {{ $pessoa->genero }}
            </div>

            @if ($profissional)
                <div class="mt-6">
                    <h2 class="text-xl font-semibold mb-2">Dados do Profissional</h2>
                    <div class="border rounded p-4">
                        <div class="mb-2">
                            <span
                                class="font-bold text-gray-700">Especialidade:</span> {{ $profissional->especialidade }}
                        </div>
                        <div class="mb-2">
                            <span class="font-bold text-gray-700">CRM:</span> {{ $profissional->crm }}
                        </div>
                    </div>
                </div>
            @endif

            @if ($pessoa->user)
                <div class="mt-6">
                    <h2 class="text-xl font-semibold mb-2">Dados do Usuário</h2>
                    <div class="border rounded p-4">
                        <div class="mb-2">
                            <span class="font-bold text-gray-700">Email:</span> {{ $pessoa->user->email }}
                        </div>
                    </div>
                </div>
            @endif

            @if ($pessoa->paciente)
                <div class="mt-6">
                    <h2 class="text-xl font-semibold mb-2">Dados do Paciente</h2>
                    <div class="border rounded p-4">
                        <div class="mb-2">
                            <span
                                class="font-bold text-gray-700">Plano de Saúde:</span> {{ $pessoa->paciente->planoSaude }}
                        </div>
                        <div class="mb-2">
                            <span
                                class="font-bold text-gray-700">Número da Carteirinha:</span> {{ $pessoa->paciente->numeroCarteirinha }}
                        </div>
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
