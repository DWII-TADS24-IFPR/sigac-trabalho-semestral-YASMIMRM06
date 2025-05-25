<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Aluno;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DocumentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:gerenciar-documentos')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $query = Documento::with(['aluno', 'categoria'])
            ->latest();

        // Filtros
        if ($request->has('aluno_id')) {
            $query->where('aluno_id', $request->aluno_id);
        }

        if ($request->has('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        if ($request->has('search')) {
            $query->where('titulo', 'like', '%'.$request->search.'%')
                  ->orWhere('descricao', 'like', '%'.$request->search.'%');
        }

        $documentos = $query->paginate(15);
        $alunos = Aluno::orderBy('nome')->pluck('nome', 'id');
        $categorias = Categoria::orderBy('nome')->pluck('nome', 'id');

        return view('documentos.index', compact('documentos', 'alunos', 'categorias'));
    }

    public function create()
    {
        return view('documentos.create', [
            'alunos' => Aluno::orderBy('nome')->get(),
            'categorias' => Categoria::orderBy('nome')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:500',
            'arquivo' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'data_emissao' => 'required|date|before_or_equal:today',
            'aluno_id' => 'required|exists:alunos,id',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        // Upload do arquivo
        $path = $request->file('arquivo')->store('documentos', 'public');
        $validated['arquivo'] = $path;

        $documento = Documento::create($validated);

        return redirect()->route('documentos.show', $documento)
            ->with('toast_success', 'Documento cadastrado com sucesso!');
    }

    public function show(Documento $documento)
    {
        return view('documentos.show', compact('documento'));
    }

    public function edit(Documento $documento)
    {
        return view('documentos.edit', [
            'documento' => $documento,
            'alunos' => Aluno::orderBy('nome')->get(),
            'categorias' => Categoria::orderBy('nome')->get()
        ]);
    }

    public function update(Request $request, Documento $documento)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:500',
            'arquivo' => 'sometimes|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'data_emissao' => 'required|date|before_or_equal:today',
            'aluno_id' => 'required|exists:alunos,id',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        // Atualiza arquivo se fornecido
        if ($request->hasFile('arquivo')) {
            // Remove arquivo antigo
            Storage::disk('public')->delete($documento->arquivo);
            
            // Salva novo arquivo
            $path = $request->file('arquivo')->store('documentos', 'public');
            $validated['arquivo'] = $path;
        }

        $documento->update($validated);

        return redirect()->route('documentos.show', $documento)
            ->with('toast_success', 'Documento atualizado com sucesso!');
    }

    public function destroy(Documento $documento)
    {
        // Remove arquivo físico
        Storage::disk('public')->delete($documento->arquivo);
        
        $documento->delete();

        return redirect()->route('documentos.index')
            ->with('toast_success', 'Documento movido para a lixeira!');
    }

    public function restore($id)
    {
        $documento = Documento::onlyTrashed()->findOrFail($id);
        $documento->restore();

        return redirect()->route('documentos.show', $documento)
            ->with('toast_success', 'Documento restaurado com sucesso!');
    }

    public function download(Documento $documento)
    {
        return Storage::disk('public')->download($documento->arquivo);
    }
}