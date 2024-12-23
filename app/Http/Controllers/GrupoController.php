<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Projeto;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grupos = Grupo::all();
        return view('grupos.index', compact('grupos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projetos = Projeto::all();
        return view('grupos.create', compact('projetos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'projeto_id' => 'required|exists:projetos,id',
            'denominacao' => ['required', 'string', 'max:255'],
        ]);
        Grupo::create($validatedData);

        $grupos = Grupo::all();
        switch ($request->modal_origin) {
            case 'v_paciente':
                return redirect()->route('pacientes.create', compact('grupos'));
            case 'v_projeto':
                return redirect()->route('projetos.index', compact('grupos'));
            default:
                return redirect()->route('grupos.index')->with('success', 'Grupo criado com sucesso!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Grupo $grupo)
    {
        $pacientes_agrupados = $grupo->pacientes->groupBy('condicao.denominacao');
        return view('grupos.show', compact('grupo', 'pacientes_agrupados'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grupo $grupo)
    {
        return view('grupos.edit', compact('grupo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grupo $grupo)
    {
        $request->validate([
            'denominacao' => 'required|string',
        ]);
        $grupo->update($request->all());
        return redirect()->route('grupos.show',$grupo->id)->with('success', 'Grupo atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grupo $grupo)
    {
        $grupo->delete();

        return redirect()->route('grupos.index')->with('success', 'Grupo excluído com sucesso!');
    }
}
