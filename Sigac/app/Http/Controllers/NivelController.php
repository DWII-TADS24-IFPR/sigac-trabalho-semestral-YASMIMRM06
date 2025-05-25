<?php

namespace App\Http\Controllers;

use App\Models\Nivel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NivelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:gerenciar-niveis')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $query = Nivel::query();

        if ($request->has('search')) {
            $query->where('nome', 'like', '%'.$request->search.'%')
                  ->orWhere('descricao', 'like', '%'.$request->search.'%');
        }

        $niveis = $query->orderBy('nome')->paginate(15);

        return view('niveis.index', compact('niveis'));
    }

    public function create()
    {
        return view('niveis.create', [
            'nivel' => new Nivel() // Para usar o mesmo form de edição
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255|unique:niveis',
            'descricao' => 'nullable|string|max:500',
            'ordem' => 'required|integer|min:1|unique:niveis',
            'ativo' => 'sometimes|boolean'
        ]);

        Nivel::create($validated);

        return redirect()->route('niveis.index')
            ->with('toast_success', 'Nível cadastrado com sucesso!');
    }

    public function show(Nivel $nivel)
    {
        $nivel->load(['cursos']);
        return view('niveis.show', compact('nivel'));
    }

    public function edit(Nivel $nivel)
    {
        return view('niveis.edit', compact('nivel'));
    }

    public function update(Request $request, Nivel $nivel)
    {
        $validated = $request->validate([
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('niveis')->ignore($nivel->id)
            ],
            'descricao' => 'nullable|string|max:500',
            'ordem' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('niveis')->ignore($nivel->id)
            ],
            'ativo' => 'sometimes|boolean'
        ]);

        $nivel->update($validated);

        return redirect()->route('niveis.show', $nivel)
            ->with('toast_success', 'Nível atualizado com sucesso!');
    }

    public function destroy(Nivel $nivel)
    {
        if ($nivel->cursos()->exists()) {
            return back()->with('toast_error', 
                'Não é possível excluir nível com cursos vinculados!');
        }

        $nivel->delete();

        return redirect()->route('niveis.index')
            ->with('toast_success', 'Nível movido para a lixeira!');
    }

    public function restore($id)
    {
        $nivel = Nivel::onlyTrashed()->findOrFail($id);
        $nivel->restore();

        return redirect()->route('niveis.show', $nivel)
            ->with('toast_success', 'Nível restaurado com sucesso!');
    }
}