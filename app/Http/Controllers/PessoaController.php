<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\Profissional;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $pessoas = Pessoa::all(); // Busca todas as pessoas no banco de dados
        return view('pessoas.index', ['pessoas' => $pessoas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pessoas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $validatedData = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'dataNascimento' => ['required', 'date'],
            'genero' => ['required'],
        ]);
        Pessoa::create($validatedData);
        $pessoas = Pessoa::all();
        switch ($request->modal_origin) {
            case 'v_profissional':
                return redirect()->route('profissionals.create', compact('pessoas'));
            case 'v_paciente':
                return redirect()->route('pacientes.create', compact('pessoas'));
            // Adicione mais casos aqui, se necessário
            default:
                return redirect()->route('pessoas.index')->with('success', 'Pessoa criada com sucesso!');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Pessoa $pessoa)
    {
        $profisisonal = Profissional::where('pesooa_id', $pessoa->id)->first();
        return view('pessoas.show', [
            'pessoa' => $pessoa,
            'profissional'=> $profisisonal
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pessoa $pessoa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pessoa $pessoa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pessoa $pessoa)
    {
        //
    }
}
