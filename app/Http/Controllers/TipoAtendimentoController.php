<?php

namespace App\Http\Controllers;

use App\Models\TipoAtendimento;
use Illuminate\Http\Request;

class TipoAtendimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipo_atendimentos = TipoAtendimento::all();
        return view('tipo_atendimentos.index', compact('tipo_atendimentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipo_atendimentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'denominacao' => 'required|string',
        ]);
        TipoAtendimento::create($validatedData);
        return redirect()->route('tipo_atendimentos.index')->with('success', 'Tipo de Atendimento criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoAtendimento $tipo_atendimento)
    {
        return view('tipo_atendimentos.show', compact('tipo_atendimento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoAtendimento $tipo_atendimento)
    {
        return view('tipo_atendimentos.edit', compact('tipo_atendimento', ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoAtendimento $tipo_atendimento)
    {
        $request->validate([
            'denominacao' => 'required|string',
        ]);

        $tipo_atendimento->update($request->all());

        return redirect()->route('tipo_atendimentos.index')->with('success', 'Tipo de Atendimento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoAtendimento $tipo_atendimento)
    {
        $tipo_atendimento->delete();

        return redirect()->route('tipo_atendimentos.index')->with('success', 'Tipo de Atendimento excluído com sucesso!');
    }
}
