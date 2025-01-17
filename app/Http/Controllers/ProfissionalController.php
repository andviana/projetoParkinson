<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\Profissional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        return view('profissionals.create');
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
            'registro' => 'required|string',
            'denominacao' => 'required|string',
            'especialidade' => 'required|string',
        ]);

        DB::transaction(function () use ($validatedData) {
            $pessoa = new Pessoa();
            $pessoa->fill([
                'nome' => $validatedData['nome'],
                'dataNascimento' => $validatedData['dataNascimento'],
                'genero' => $validatedData['genero'],
            ]);
            $pessoa->save();

            $profissional = new Profissional();
            $profissional->fill([
                'registro' => $validatedData['registro'],
                'denominacao' => $validatedData['denominacao'],
                'especialidade' => $validatedData['especialidade'],
                'pessoa_id' => $pessoa->id,
            ]);
            $profissional->save();
        });

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
            'registro' => 'required|string',
            'denominacao' => 'required|string',
            'especialidade' => 'required|string',
        ]);

        $profissional->update([
            'registro' => $request->input('registro'),
            'denominacao' => $request->input('denominacao'),
            'especialidade' => $request->input('especialidade'),
                    ]);

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
