<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($atendimento) ? __('Editar') : __('Cadastrar Atendimento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="border rounded p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6">
                        <div class="mt-6 ">
                            <h2 class="text-xl font-semibold mb-2">Dados do Paciente</h2>
                            <div class="border rounded p-4 shadow bg-gradient-to-br bg-gray-100">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <span class="font-bold text-gray-400">Nome:</span> {{ $paciente->pessoa->nome }}
                                    </div>
                                    @if ($paciente->grupo)
                                        <div>
                                            <span class="font-bold text-gray-400">Condição:</span> {{ $paciente->condicao->denominacao }}
                                        </div>
                                        <div>
                                            <span class="font-bold text-gray-400">Projeto:</span> {{ $paciente->grupo->projeto->denominacao }}
                                        </div>
                                        <div>
                                            <span class="font-bold text-gray-400">Grupo:</span> {{ $paciente->grupo->denominacao }}
                                        </div>
                                    @else
                                        <div >
                                            <span class="font-bold text-red-400">*** Paciente não está vinculado a nenhum grupo ***</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="mt-6">
                            <h2 class="text-xl font-semibold mb-2">Atendimento</h2>
                            <div class="border rounded p-4 shadow bg-gradient-to-br bg-gray-100">
                                <span class="font-bold text-gray-400">Tipo:</span>
                                <span class="p-4 font-semibold">{{$tipo_atendimento->denominacao}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 text-gray-900">
                        <form method="POST" action="{{ isset($atendimento) ? route('atendimentos.update', $atendimento) : route('atendimentos.store') }}">
                            @csrf
                            @if(isset($atendimento))
                                @method('PUT')
                            @endif
                            <input type="hidden" id="tipo_atendimento_id" name="tipo_atendimento_id" value="{{$tipo_atendimento->id}}">
                            <input type="hidden" id="paciente_id" name="paciente_id" value="{{$paciente->id}}">
                            <div class="mb-4">
                                <label for="dataAtendimento" class="block text-sm font-light text-gray-700">Data do Atendimento</label>
                                <input
                                    type="date"
                                    name="dataAtendimento"
                                    id="dataAtendimento"
                                    value="{{ old('dataAtendimento', isset($dataAtendimento) ? $atendimento->$dataAtendimento->toDateString('Y-m-d') : now()->toDateString('Y-m-d')) }}"
                                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                    max="{{ now()->toDateString('Y-m-d') }}"
                                    min="1900-01-01"
                                />
                                <x-input-error :messages="$errors->get('dataAtendimento')" class="mt-2" />
                            </div>
                            <div class="mb-4">
                                <label for="profissional_id" class="block text-gray-700 text-sm font-light mb-2">Profissional:</label>
                                <select name="profissional_id" id="profissional_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option value="">Selecione um profissional</option>
                                    @foreach ($profissionais as $profissional)
                                        <option value="{{ $profissional->id }}" {{ isset($atendimento) && $atendimento->profissional_id == $profissional->id ? 'selected' : '' }}>
                                            {{ $profissional->denominacao }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h3 class="card-header">TCS</h3>
                                    <div class="border shadow-sm rounded p-4">
                                        <div >
                                            <input type="checkbox"
                                                   name="janela_temporal_e"
                                                   id="janela_temporal_e" {{ isset($atendimento) && $atendimento->atendimentoTCS->janela_temporal_e ? 'checked' : '' }}
                                                   class="shadow appearance-none border rounded text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            <label for="janela_temporal_e" class="text-gray-700 text-sm font-bold mb-2">Janela Temporal E</label>
                                        </div>
                                        <div class="mb-4">
                                            <input type="checkbox"
                                                   name="janela_temporal_d"
                                                   id="janela_temporal_d" {{ isset($atendimento) && $atendimento->atendimentoTCS->janela_temporal_d ? 'checked' : '' }}
                                                   class="shadow appearance-none border rounded text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            <label for="janela_temporal_d" class="text-gray-700 text-sm font-bold ">Janela Temporal D</label>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="mb-4">
                                                <label for="observacao_mesoencefalo" class="block text-gray-700 text-sm font-bold mb-2">Observação Mesoencéfalo:</label>
                                                <select name="observacao_mesoencefalo" id="observacao_mesoencefalo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                    <option value="-1" {{ isset($atendimento) && $atendimento->atendimentoTCS->observacao_mesoencefalo == -1 ? 'selected' : '' }}>Selecione uma opção</option>
                                                    <option value="0" {{ isset($atendimento) && $atendimento->atendimentoTCS->observacao_mesoencefalo == 0 ? 'selected' : '' }}>Não observável</option>
                                                    <option value="1" {{ isset($atendimento) && $atendimento->atendimentoTCS->observacao_mesoencefalo == 1 ? 'selected' : '' }}>Não definido</option>
                                                    <option value="2" {{ isset($atendimento) && $atendimento->atendimentoTCS->observacao_mesoencefalo == 2 ? 'selected' : '' }}>Bem definido</option>
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <label for="area_total_mesoencefalo" class="block text-gray-700 text-sm font-bold mb-2">Área Total Mesoencéfalo:</label>
                                                <input type="number" step="0.01" name="area_total_mesoencefalo" id="area_total_mesoencefalo" value="{{ old('area_total_mesoencefalo', isset($atendimento) ? $atendimento->atendimentoTCS->area_total_mesoencefalo : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            </div>
                                        </div>
                                            <div class="">
                                                <input type="checkbox" name="hiperecogenecidade_e" id="hiperecogenecidade_e" {{ isset($atendimento) && $atendimento->atendimentoTCS->hiperecogenecidade_e ? 'checked' : '' }}
                                                class="shadow appearance-none border rounded text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                <label for="hiperecogenecidade_e" class=" text-gray-700 text-sm font-bold mb-2">Hiperecogenicidade E</label>
                                            </div>
                                            <div class="mb-4">
                                                <input type="checkbox" name="hiperecogenecidade_d" id="hiperecogenecidade_d" {{ isset($atendimento) && $atendimento->atendimentoTCS->hiperecogenecidade_d ? 'checked' : '' }}
                                                class="shadow appearance-none border rounded text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                <label for="hiperecogenecidade_d" class=" text-gray-700 text-sm font-bold mb-2">Hiperecogenicidade D</label>
                                            </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="mb-4">
                                                <label for="hiperecogenecidade_d_area" class="block text-gray-700 text-sm font-bold mb-2">Hiperecogenicidade D Área:</label>
                                                <input type="number" step="0.01" name="hiperecogenecidade_d_area" id="hiperecogenecidade_d_area"
                                                       value="{{ old('hiperecogenecidade_d_area', isset($atendimento) ? $atendimento->atendimentoTCS->hiperecogenecidade_d_area : '') }}"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            </div>
                                            <div class="mb-4">
                                                <label for="hiperecogenecidade_e_area" class="block text-gray-700 text-sm font-bold mb-2">Hiperecogenicidade E Área:</label>
                                                <input type="number" step="0.01" name="hiperecogenecidade_e_area" id="hiperecogenecidade_e_area"
                                                       value="{{ old('hiperecogenecidade_e_area', isset($atendimento) ? $atendimento->atendimentoTCS->hiperecogenecidade_e_area : '') }}"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div>
                            <h3>Doppler</h3>
                                <div class="border shadow-sm rounded p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <h3>P1 Esquerdo</h3>
                                            <div class="border shadow-sm rounded p-4">
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div class="mb-4">
                                                        <label for="p1_e_indice_pulsatilidade" class="block text-gray-700 text-sm font-bold mb-2">Pulsatilidade:</label>
                                                        <input type="number" step="0.01" name="p1_e_indice_pulsatilidade" id="p1_e_indice_pulsatilidade" value="{{ old('p1_e_indice_pulsatilidade', isset($atendimento) ? $atendimento->atendimentoDoppler->p1_e_indice_pulsatilidade : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="p1_e_velocidade_media" class="block text-gray-700 text-sm font-bold mb-2">Vel. Média:</label>
                                                        <input type="number" step="0.01" name="p1_e_velocidade_media" id="p1_e_velocidade_media" value="{{ old('p1_e_velocidade_media', isset($atendimento) ? $atendimento->atendimentoDoppler->p1_e_velocidade_media : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="p1_e_pico_diastolico" class="block text-gray-700 text-sm font-bold mb-2">Pico Diastólico:</label>
                                                        <input type="number" step="0.01" name="p1_e_pico_diastolico" id="p1_e_pico_diastolico" value="{{ old('p1_e_pico_diastolico', isset($atendimento) ? $atendimento->atendimentoDoppler->p1_e_pico_diastolico : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="p1_e_pico_cistolico" class="block text-gray-700 text-sm font-bold mb-2">Pico Sistólico:</label>
                                                        <input type="number" step="0.01" name="p1_e_pico_cistolico" id="p1_e_pico_cistolico" value="{{ old('p1_e_pico_cistolico', isset($atendimento) ? $atendimento->atendimentoDoppler->p1_e_pico_cistolico : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <h3>P1 Direito</h3>
                                            <div class="border shadow-sm rounded p-4">
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div class="mb-4">
                                                        <label for="p1_d_indice_pulsatilidade" class="block text-gray-700 text-sm font-bold mb-2">Pulsatilidade:</label>
                                                        <input type="number" step="0.01" name="p1_d_indice_pulsatilidade" id="p1_d_indice_pulsatilidade" value="{{ old('p1_d_indice_pulsatilidade', isset($atendimento) ? $atendimento->atendimentoDoppler->p1_d_indice_pulsatilidade : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="p1_d_velocidade_media" class="block text-gray-700 text-sm font-bold mb-2">Vel. Média:</label>
                                                        <input type="number" step="0.01" name="p1_d_velocidade_media" id="p1_d_velocidade_media" value="{{ old('p1_d_velocidade_media', isset($atendimento) ? $atendimento->atendimentoDoppler->p1_d_velocidade_media : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="p1_d_pico_diastolico" class="block text-gray-700 text-sm font-bold mb-2">Pico Diastólico:</label>
                                                        <input type="number" step="0.01" name="p1_d_pico_diastolico" id="p1_d_pico_diastolico" value="{{ old('p1_d_pico_diastolico', isset($atendimento) ? $atendimento->atendimentoDoppler->p1_d_pico_diastolico : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="p1_d_pico_cistolico" class="block text-gray-700 text-sm font-bold mb-2">Pico Sistólico:</label>
                                                        <input type="number" step="0.01" name="p1_d_pico_cistolico" id="p1_d_pico_cistolico" value="{{ old('p1_d_pico_cistolico', isset($atendimento) ? $atendimento->atendimentoDoppler->p1_d_pico_cistolico : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                                <div>
                                    <h3>NV</h3>
                                    <div class="border rounded p-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="mb-4">
                                                <label for="area_secao_transversal_e" class="block text-gray-700 text-sm font-bold mb-2">Área Seção Transversal E:</label>
                                                <input type="number" step="0.01" name="area_secao_transversal_e" id="area_secao_transversal_e" value="{{ old('area_secao_transversal_e', isset($atendimento) ? $atendimento->atendimentoNV->area_secao_transversal_e : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            </div>
                                            <div class="mb-4">
                                                <label for="area_secao_transversal_d" class="block text-gray-700 text-sm font-bold mb-2">Área Seção Transversal D:</label>
                                                <input type="number" step="0.01" name="area_secao_transversal_d" id="area_secao_transversal_d" value="{{ old('area_secao_transversal_d', isset($atendimento) ? $atendimento->atendimentoNV->area_secao_transversal_d : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center p-6 space-x-2 rounded-b  border-gray-200 dark:border-gray-600">
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Salvar</button>
                                <button type="button" onclick="window.location.href='{{ route('pacientes.index') }}'" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
