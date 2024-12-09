<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\Profissional;
use Illuminate\Http\Request;

class ProfissionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profissionais = Profissional::with('pessoa')->get();
        return view('profissionals.index', compact('profissionais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pessoas = Pessoa::all();
        return view('profissionals.create', compact('pessoas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'registro' => 'required|string',
            'denominacao' => 'required|string',
            'especialidade' => 'required|string',
            'pessoa_id' => 'required|exists:pessoas,id',
        ]);
        Profissional::create($validatedData);
        return redirect()->route('profissionals.index')->with('success', 'Profissional criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profissional $profissional)
    {
        return view('profissionals.show', compact('profissional'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profissional $profissional)
    {
        $pessoas = Pessoa::all();
        return view('profissionals.edit', compact('profissional', 'pessoas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profissional $profissional)
    {
        $request->validate([
            'registro' => 'required|string' . $profissional->id,
            'denominacao' => 'required|string',
            'pessoa_id' => 'required|exists:pessoas,id',
        ]);

        $profissional->update($request->all());

        return redirect()->route('profissionals.index')->with('success', 'Profissional atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profissional $profissional)
    {
        $profissional->delete();

        return redirect()->route('profissionals.index')->with('success', 'Profissional excluído com sucesso!');
    }
}
