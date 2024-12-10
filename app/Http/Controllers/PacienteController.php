<?php

namespace App\Http\Controllers;

use App\Models\Condicao;
use App\Models\Grupo;
use App\Models\Paciente;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Paciente::with('pessoa')->get();
        return view('pacientes.index', compact('pacientes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pessoas = Pessoa::all();
        $grupos = Grupo::all();
        $condicaos = Condicao::all();
                return view('pacientes.create', compact('pessoas', 'grupos', 'condicaos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pessoa_id' => 'required|exists:pessoas,id',
            'grupo_id' => 'required|exists:grupos,id',
            'condicao_id' => 'required|exists:condicaos,id',
        ]);
        $paciente = [
            'pessoa_id' => $validatedData['pessoa_id'],
            'grupo_id' => $validatedData['grupo_id'],
            'condicao_id' => $validatedData['condicao_id'],
            'ativo' => true,
            'dataVinculo' => now(),
            'dataDesligamento' => null,
        ];
        Paciente::create($paciente);
        return redirect()->route('pacientes.index')->with('success', 'Paciente criado com sucesso!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        return view('pacientes.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paciente $paciente)
    {
        $pessoas = Pessoa::all();
        $grupos = Grupo::all();
        $condicaos = Condicao::all();
        return view('pacientes.edit', compact('paciente','pessoas', 'grupos', 'condicaos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $paciente)
    {
        $validatedData = $request->validate([
            'pessoa_id' => 'required|exists:pessoas,id',
            'grupo_id' => 'required|exists:grupos,id',
            'condicao_id' => 'required|exists:condicaos,id',
        ]);
        $paciente->update($validatedData);
        return redirect()->route('pacientes.index')->with('success', 'Paciente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        $paciente->ativo = false;
        $paciente->dataDesligamento = now();
        $paciente->save();

        return redirect()->route('pacientes.index')->with('success', 'Paciente desvinculado com sucesso!');
    }
}
