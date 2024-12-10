<?php

namespace App\Http\Controllers;

use App\Models\Condicao;
use App\Models\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
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
        Grupo::create($validatedData);
        $grupos = Grupo::all();
        switch ($request->modal_origin) {
            case 'v_paciente':
                return redirect()->route('pacientes.create', compact('grupos'));
            default:
                return redirect()->route('grupos.index')->with('success', 'Grupo criada com sucesso!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Grupo $grupo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grupo $grupo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grupo $grupo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grupo $grupo)
    {
        //
    }
}
