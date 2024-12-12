<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\AtendimentoDoppler;
use App\Models\AtendimentoNV;
use App\Models\AtendimentoTCS;
use App\Models\Paciente;
use App\Models\Profissional;
use App\Models\TipoAtendimento;
use Illuminate\Http\Request;

class AtendimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $paciente = Paciente::with('pessoa')->find(request('id'));

        $tipo_atendimento = TipoAtendimento::where('denominacao', 'TCS+DOPPLER+NV')->first();
        $profissionais = Profissional::all();
        return view('atendimentos.create', compact('profissionais', 'tipo_atendimento', 'paciente'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'tipo_atendimento_id' => 'required|exists:tipo_atendimentos,id',
            'profissional_id' => 'required|exists:profissionals,id',
            'dataAtendimento' => [
                'required',
                'date',
                'before_or_equal:today', // Menor ou igual a hoje
                'after_or_equal:1900-01-01' // Maior ou igual a 01/01/1900
            ],
        ]);

        $atendimento = new Atendimento();
        $atendimento->paciente_id = $validatedData['paciente_id'];
        $atendimento->tipo_atendimento_id = $validatedData['tipo_atendimento_id'];
        $atendimento->dataAtendimento = $validatedData['dataAtendimento'];
        $atendimento->user_id = auth()->user()->id;

        $atendimento->save();

        $atendimentoNV = new AtendimentoNV($request->only([
            'area_secao_transversal_d',
            'area_secao_transversal_e',
            'profissional_id',
        ]));

        $atendimentoTCS = new AtendimentoTCS($request->only([
            'janela_temporal_d',
            'janela_temporal_e',
            'observacao_mesoencefalo',
            'area_total_mesoencefalo',
            'hipereconecidade_d',
            'hipereconecidade_d_area',
            'hipereconecidade_e',
            'hipereconecidade_e_area',
            'profissional_id',
        ]));

        $atendimentoDoppler = new AtendimentoDoppler($request->only([
            'p1_d_indice_pulsatilidade',
            'p1_d_velocidade_media',
            'p1_d_pico_distolico',
            'p1_d_pico_cistolico',
            'p1_e_indice_pulsatilidade',
            'p1_e_velocidade_media',
            'p1_e_pico_distolico',
            'p1_e_pico_cistolico',
            'profissional_id',
        ]));

        $atendimento->atendimentoNV->save($atendimentoNV);
        $atendimento->atendimentoTCS->save($atendimentoTCS);
        $atendimento->atendimentoDoppler->save($atendimentoDoppler);

        return redirect()->route('pacientes.index')->with('success', 'Atendimento criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Atendimento $atendimento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Atendimento $atendimento)
    {
        $profissionais = Profissional::all();
        return view('atendimentos.edit', compact('atendimento', 'profissionais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Atendimento $atendimento)
    {
        dump('teste');die;
        $validatedData = $request->validate([
            'profissional_id' => 'required|exists:profissionais,id',
            // ... outras validações para os campos do atendimento
        ]);

        $atendimento->profissional_id = $validatedData['profissional_id'];
        $atendimento->save();

        $atendimento->atendimentoNV()->update($request->only([
            'area_secao_transversal_d',
            'area_secao_transversal_e',
        ]));

        $atendimento->atendimentoTCS()->update($request->only([
            'janela_temporal_d',
            'janela_temporal_e',
            'observacao_mesoencefalo',
            'area_total_mesoencefalo',
            'hipereconecidade_d',
            'hipereconecidade_d_area',
            'hipereconecidade_e',
            'hipereconecidade_e_area',
        ]));

        $atendimento->atendimentoDoppler()->update($request->only([
            'p1_d_indice_pulsatilidade',
            'p1_d_velocidade_media',
            'p1_d_pico_distolico',
            'p1_d_pico_cistolico',
            'p1_e_indice_pulsatilidade',
            'p1_e_velocidade_media',
            'p1_e_pico_distolico',
            'p1_e_pico_cistolico',
        ]));

        return redirect()->route('atendimentos.index')->with('success', 'Atendimento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Atendimento $atendimento)
    {
        //
    }
}
