<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TurmaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:gerenciar-turmas')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $query = Turma::with(['curso']);

        if ($request->has('curso_id')) {
            $query->where('curso_id', $request->curso_id);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('search')) {
            $query->where('nome', 'like', '%'.$request->search.'%');
        }

        $turmas = $query->orderBy('nome')->paginate(15);
        $cursos = Curso::orderBy('nome')->pluck('nome', 'id');

        return view('turmas.index', compact('turmas', 'cursos'));
    }

    public function create()
    {
        return view('turmas.create', [
            'cursos' => Curso::orderBy('nome')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:500',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
            'vagas' => 'required|integer|min:1',
            'curso_id' => 'required|exists:cursos,id',
            'status' => 'required|in:planejada,ativa,concluida,cancelada'
        ]);

        Turma::create($validated);

        return redirect()->route('turmas.index')
            ->with('toast_success', 'Turma cadastrada com sucesso!');
    }

    public function show(Turma $turma)
    {
        $turma->load(['curso', 'alunos']);
        return view('turmas.show', compact('turma'));
    }

    public function edit(Turma $turma)
    {
        return view('turmas.edit', [
            'turma' => $turma,
            'cursos' => Curso::orderBy('nome')->get()
        ]);
    }

    public function update(Request $request, Turma $turma)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:500',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
            'vagas' => 'required|integer|min:1',
            'curso_id' => 'required|exists:cursos,id',
            'status' => 'required|in:planejada,ativa,concluida,cancelada'
        ]);

        $turma->update($validated);

        return redirect()->route('turmas.show', $turma)
            ->with('toast_success', 'Turma atualizada com sucesso!');
    }

    public function destroy(Turma $turma)
    {
        if ($turma->alunos()->exists()) {
            return back()->with('toast_error', 
                'Não é possível excluir turma com alunos vinculados!');
        }

        $turma->delete();

        return redirect()->route('turmas.index')
            ->with('toast_success', 'Turma movida para a lixeira!');
    }

    public function restore($id)
    {
        $turma = Turma::onlyTrashed()->findOrFail($id);
        $turma->restore();

        return redirect()->route('turmas.show', $turma)
            ->with('toast_success', 'Turma restaurada com sucesso!');
    }
}