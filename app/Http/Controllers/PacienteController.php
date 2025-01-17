<?php

namespace App\Http\Controllers;

use App\Models\Condicao;
use App\Models\Grupo;
use App\Models\Paciente;
use App\Models\Pessoa;
use App\Models\Profissional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $grupos = Grupo::all();
        $condicaos = Condicao::all();
                return view('pacientes.create', compact( 'grupos', 'condicaos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'dataNascimento' => [
                'required',
                'date',
                'before_or_equal:today', // Menor ou igual a hoje
                'after_or_equal:1900-01-01' // Maior ou igual a 01/01/1900
            ],
            'genero' => ['required'],
            'grupo_id' => 'required|exists:grupos,id',
            'condicao_id' => 'required|exists:condicaos,id',
        ]);

        DB::transaction(function () use ($validatedData) {
            $pessoa = new Pessoa();
            $pessoa->fill([
                'nome' => $validatedData['nome'],
                'dataNascimento' => $validatedData['dataNascimento'],
                'genero' => $validatedData['genero'],
            ]);
            $pessoa->save();

            $paciente = new Paciente();
            $paciente->fill([
                'grupo_id' => $validatedData['grupo_id'],
                'condicao_id' => $validatedData['condicao_id'],
                'ativo' => true,
                'dataVinculo' => now(),
                'dataDesligamento' => null,
                'pessoa_id' => $pessoa->id,
            ]);
            $paciente->save();
        });

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
        $grupos = Grupo::all();
        $condicaos = Condicao::all();
        return view('pacientes.edit', compact('paciente', 'grupos', 'condicaos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $paciente)
    {
//        dump($request->get('pessoa_id')); die;
        $validatedData = $request->validate([
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
