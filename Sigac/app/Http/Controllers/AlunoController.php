<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AlunoController extends Controller
{
    // Adicionando construtor para políticas de acesso
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('can:admin')->only(['create', 'store', 'destroy', 'restore']);
    }

    // Listagem com filtros e busca
    public function index(Request $request)
    {
        $query = Aluno::with(['curso', 'turma', 'user'])
            ->orderBy('nome');

        // Filtro por curso
        if ($request->has('curso_id')) {
            $query->where('curso_id', $request->curso_id);
        }

        // Filtro por turma
        if ($request->has('turma_id')) {
            $query->where('turma_id', $request->turma_id);
        }

        // Busca por nome
        if ($request->has('search')) {
            $query->where('nome', 'like', '%'.$request->search.'%');
        }

        $alunos = $query->paginate(15); // Alterado para 15 itens por página

        $cursos = Curso::pluck('nome', 'id');
        $turmas = Turma::pluck('nome', 'id');

        return view('alunos.index', compact('alunos', 'cursos', 'turmas'));
    }

    // Criação com dados necessários
    public function create()
    {
        $cursos = Curso::active()->get();
        $turmas = Turma::active()->get();
        $users = User::whereDoesntHave('aluno')->get();

        return view('alunos.create', compact('cursos', 'turmas', 'users'));
    }

    // Armazenamento com validação aprimorada
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:150',
            'cpf' => [
                'required',
                'string',
                'size:11',
                'unique:alunos',
                new \App\Rules\CpfValidation
            ],
            'email' => 'required|email|unique:alunos',
            'senha' => 'required|string|min:8|confirmed', // Adicionado confirmação de senha
            'curso_id' => 'required|exists:cursos,id',
            'turma_id' => 'required|exists:turmas,id',
            'user_id' => 'required|exists:users,id|unique:alunos'
        ]);

        $validated['senha'] = Hash::make($request->senha);
        $validated['data_cadastro'] = now();

        Aluno::create($validated);

        return redirect()->route('alunos.index')
            ->with('toast_success', 'Aluno cadastrado com sucesso!'); // Usando toast
    }

    // Visualização com mais detalhes
    public function show(Aluno $aluno)
    {
        $aluno->load(['curso', 'turma', 'user', 'matriculas.disciplina']);
        
        return view('alunos.show', compact('aluno'));
    }

    // Edição com dados necessários
    public function edit(Aluno $aluno)
    {
        $cursos = Curso::active()->get();
        $turmas = Turma::active()->get();
        $users = User::whereDoesntHave('aluno')->orWhere('id', $aluno->user_id)->get();

        return view('alunos.edit', compact('aluno', 'cursos', 'turmas', 'users'));
    }

    // Atualização com validação aprimorada
    public function update(Request $request, Aluno $aluno)
    {
        $validated = $request->validate([
            'nome' => 'sometimes|string|max:150',
            'cpf' => [
                'sometimes',
                'string',
                'size:11',
                Rule::unique('alunos')->ignore($aluno->id),
                new \App\Rules\CpfValidation
            ],
            'email' => 'sometimes|email|unique:alunos,email,'.$aluno->id,
            'senha' => 'nullable|string|min:8|confirmed',
            'curso_id' => 'sometimes|exists:cursos,id',
            'turma_id' => 'sometimes|exists:turmas,id',
            'user_id' => [
                'sometimes',
                'exists:users,id',
                Rule::unique('alunos')->ignore($aluno->id)
            ]
        ]);

        if ($request->filled('senha')) {
            $validated['senha'] = Hash::make($request->senha);
        } else {
            unset($validated['senha']);
        }

        $aluno->update($validated);

        return redirect()->route('alunos.show', $aluno->id)
            ->with('toast_success', 'Aluno atualizado com sucesso!');
    }

    // Exclusão com verificação de relacionamentos
    public function destroy(Aluno $aluno)
    {
        if ($aluno->matriculas()->exists()) {
            return back()->with('toast_error', 
                'Não é possível excluir aluno com matrículas vinculadas!');
        }

        $aluno->delete();

        return redirect()->route('alunos.index')
            ->with('toast_success', 'Aluno movido para a lixeira!');
    }

    // Restauração
    public function restore($id)
    {
        $aluno = Aluno::onlyTrashed()->findOrFail($id);
        $aluno->restore();

        return redirect()->route('alunos.index')
            ->with('toast_success', 'Aluno restaurado com sucesso!');
    }

    // Listagem de alunos excluídos
    public function trashed()
    {
        $alunos = Aluno::onlyTrashed()
            ->with(['curso', 'turma'])
            ->orderBy('deleted_at', 'desc')
            ->paginate(15);

        return view('alunos.trashed', compact('alunos'));
    }
}