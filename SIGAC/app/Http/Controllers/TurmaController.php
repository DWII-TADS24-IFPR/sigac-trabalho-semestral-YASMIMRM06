<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Models\Curso;
use App\Http\Requests\TurmaRequest;

class TurmaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(TurmaRequest $request)
    {
        Turma::create($request->validated());

        return redirect()->route('admin.turmas.index')->with('success', 'Turma criada com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TurmaRequest $request, Turma $turma)
    {
        $turma->update($request->validated());

        return redirect()->route('admin.turmas.index')->with('success', 'Turma atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Turma $turma)
    {
        $turma->delete();

        return redirect()->route('admin.turmas.index')->with('success', 'Turma deletada com sucesso!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cursos = Curso::all();
        return view('admin.turmas.create', compact('cursos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Turma $turma)
    {
        $cursos = Curso::all();
        return view('admin.turmas.edit', compact('turma', 'cursos'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $turmas = Turma::with('curso')->paginate(10);
        return view('admin.turmas.index', compact('turmas'));
    }
    /**
     * Display the specified resource.
     */
    public function show(Turma $turma)
    {
        return view('turmas.show', compact('turma'));
    }

    /**
     * Display a listing of the trashed resources (soft-deleted).
     */
    public function trashed()
    {
        $turmas = Turma::onlyTrashed()->get();
        return view('turmas.trashed', compact('turmas'));
    }
    
}
