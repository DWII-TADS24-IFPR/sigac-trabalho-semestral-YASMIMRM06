<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('can:gerenciar-categorias')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(Request $request)
    {
        $query = Categoria::query();

        // Filtro por busca
        if ($request->has('search')) {
            $query->where('nome', 'like', '%'.$request->search.'%')
                  ->orWhere('descricao', 'like', '%'.$request->search.'%');
        }

        // Ordenação personalizada
        $orderBy = in_array($request->order_by, ['nome', 'created_at', 'updated_at']) 
            ? $request->order_by 
            : 'nome';

        $categorias = $query->orderBy($orderBy)
            ->paginate(15)
            ->appends($request->query());

        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create', [
            'categoria' => new Categoria() // Para usar o mesmo form de edição
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255|unique:categorias',
            'descricao' => 'nullable|string|max:500',
            'icone' => 'nullable|string|max:50',
            'cor' => 'nullable|string|size:7|starts_with:#',
            'ativo' => 'sometimes|boolean'
        ]);

        // Gera slug automático
        $validated['slug'] = Str::slug($validated['nome']);

        $categoria = Categoria::create($validated);

        return redirect()->route('categorias.show', $categoria)
            ->with('toast_success', 'Categoria criada com sucesso!');
    }

    public function show(Categoria $categoria)
    {
        // Carrega os produtos relacionados (se existir)
        if (method_exists($categoria, 'produtos')) {
            $categoria->load(['produtos' => function($query) {
                $query->orderBy('nome')->limit(10);
            }]);
        }

        return view('categorias.show', compact('categoria'));
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $validated = $request->validate([
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categorias')->ignore($categoria->id)
            ],
            'descricao' => 'nullable|string|max:500',
            'icone' => 'nullable|string|max:50',
            'cor' => 'nullable|string|size:7|starts_with:#',
            'ativo' => 'sometimes|boolean'
        ]);

        // Atualiza slug se o nome mudou
        if ($categoria->nome !== $validated['nome']) {
            $validated['slug'] = Str::slug($validated['nome']);
        }

        $categoria->update($validated);

        return redirect()->route('categorias.show', $categoria)
            ->with('toast_success', 'Categoria atualizada com sucesso!');
    }

    public function destroy(Categoria $categoria)
    {
        // Verifica se a categoria tem produtos associados
        if (method_exists($categoria, 'produtos') && $categoria->produtos()->exists()) {
            return back()->with('toast_error', 
                'Não é possível excluir categoria com produtos vinculados!');
        }

        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('toast_success', 'Categoria movida para a lixeira!');
    }

    public function restore($id)
    {
        $categoria = Categoria::onlyTrashed()->findOrFail($id);
        $categoria->restore();

        return redirect()->route('categorias.show', $categoria)
            ->with('toast_success', 'Categoria restaurada com sucesso!');
    }

    public function trashed()
    {
        $categorias = Categoria::onlyTrashed()
            ->orderBy('deleted_at', 'desc')
            ->paginate(15);

        return view('categorias.trashed', compact('categorias'));
    }
}