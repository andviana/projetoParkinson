<?php

namespace App\Http\Controllers;

use App\Models\Condicao;
use Illuminate\Http\Request;

class CondicaoController extends Controller
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
    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Condicao $condicao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Condicao $condicao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Condicao $condicao)
    {
        //
    }
}
