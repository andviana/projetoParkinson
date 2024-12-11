<?php

namespace App\Http\Controllers;

use App\Models\Condicao;
use App\Models\Paciente;
use Illuminate\Http\Request;

class CondicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $condicaos = Condicao::all(); // Busca todas as pessoas no banco de dados
        return view('condicaos.index', ['condicaos' => $condicaos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('condicaos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'denominacao' => ['required', 'string', 'max:255'],
        ]);
        Condicao::create($validatedData);
        $condicaos = Condicao::all();
        switch ($request->modal_origin) {
            case 'v_paciente':
                return redirect()->route('pacientes.create', compact('condicaos'));
            default:
                return redirect()->route('condicaos.index')->with('success', 'Condição criada com sucesso!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Condicao $condicao)
    {
        $pacientes = Paciente::where('condicao_id', $condicao->id);
        return view('condicaos.show', compact('condicao', 'pacientes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Condicao $condicao)
    {
        return view('condicaos.edit', compact('condicao'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Condicao $condicao)
    {
        $request->validate([
            'denominacao' => 'required|string',
        ]);
        $condicao->update($request->all());
        return redirect()->route('condicaos.index')->with('success', 'Condição atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Condicao $condicao)
    {
        $condicao->delete();

        return redirect()->route('condicaos.index')->with('success', 'Condição excluída com sucesso!');
    }
}
