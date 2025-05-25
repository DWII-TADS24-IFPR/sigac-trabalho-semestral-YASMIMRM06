<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Categoria;
use App\Models\Nivel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CursoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:gerenciar-cursos')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $query = Curso::with(['categoria', 'nivel'])
            ->orderBy('nome');

        // Filtros
        if ($request->has('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        if ($request->has('nivel_id')) {
            $query->where('nivel_id', $request->nivel_id);
        }

        if ($request->has('search')) {
            $query->where('nome', 'like', '%'.$request->search.'%');
        }

        $cursos = $query->paginate(15);
        $categorias = Categoria::orderBy('nome')->pluck('nome', 'id');
        $niveis = Nivel::orderBy('nome')->pluck('nome', 'id');

        return view('cursos.index', compact('cursos', 'categorias', 'niveis'));
    }

    public function create()
    {
        return view('cursos.create', [
            'categorias' => Categoria::orderBy('nome')->get(),
            'niveis' => Nivel::orderBy('nome')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255|unique:cursos',
            'descricao' => 'nullable|string|max:1000',
            'carga_horaria' => 'required|integer|min:1|max:2000',
            'categoria_id' => 'required|exists:categorias,id',
            'nivel_id' => 'required|exists:niveis,id',
            'ativo' => 'sometimes|boolean'
        ]);

        $curso = Curso::create($validated);

        return redirect()->route('cursos.show', $curso)
            ->with('toast_success', 'Curso cadastrado com sucesso!');
    }

    public function show(Curso $curso)
    {
        $curso->load(['turmas', 'disciplinas']);
        return view('cursos.show', compact('curso'));
    }

    public function edit(Curso $curso)
    {
        return view('cursos.edit', [
            'curso' => $curso,
            'categorias' => Categoria::orderBy('nome')->get(),
            'niveis' => Nivel::orderBy('nome')->get()
        ]);
    }

    public function update(Request $request, Curso $curso)
    {
        $validated = $request->validate([
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('cursos')->ignore($curso->id)
            ],
            'descricao' => 'nullable|string|max:1000',
            'carga_horaria' => 'required|integer|min:1|max:2000',
            'categoria_id' => 'required|exists:categorias,id',
            'nivel_id' => 'required|exists:niveis,id',
            'ativo' => 'sometimes|boolean'
        ]);

        $curso->update($validated);

        return redirect()->route('cursos.show', $curso)
            ->with('toast_success', 'Curso atualizado com sucesso!');
    }

    public function destroy(Curso $curso)
    {
        if ($curso->turmas()->exists() || $curso->disciplinas()->exists()) {
            return back()->with('toast_error', 
                'Não é possível excluir curso com turmas ou disciplinas vinculadas!');
        }

        $curso->delete();

        return redirect()->route('cursos.index')
            ->with('toast_success', 'Curso movido para a lixeira!');
    }

    public function restore($id)
    {
        $curso = Curso::onlyTrashed()->findOrFail($id);
        $curso->restore();

        return redirect()->route('cursos.show', $curso)
            ->with('toast_success', 'Curso restaurado com sucesso!');
    }
}