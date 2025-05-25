<?php

namespace App\Http\Controllers;

use App\Models\Comprovante;
use App\Models\Aluno;
use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ComprovanteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:gerenciar-comprovantes')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $query = Comprovante::with(['aluno', 'documento'])
            ->latest();

        // Filtros
        if ($request->has('aluno_id')) {
            $query->where('aluno_id', $request->aluno_id);
        }

        if ($request->has('documento_id')) {
            $query->where('documento_id', $request->documento_id);
        }

        if ($request->has('search')) {
            $query->where('titulo', 'like', '%'.$request->search.'%');
        }

        $comprovantes = $query->paginate(15);
        $alunos = Aluno::orderBy('nome')->pluck('nome', 'id');
        $documentos = Documento::orderBy('nome')->pluck('nome', 'id');

        return view('comprovantes.index', compact('comprovantes', 'alunos', 'documentos'));
    }

    public function create()
    {
        return view('comprovantes.create', [
            'alunos' => Aluno::orderBy('nome')->get(),
            'documentos' => Documento::orderBy('nome')->get()
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
            'documento_id' => 'required|exists:documentos,id'
        ]);

        // Upload do arquivo
        if ($request->hasFile('arquivo')) {
            $path = $request->file('arquivo')->store('comprovantes', 'public');
            $validated['arquivo'] = $path;
        }

        $comprovante = Comprovante::create($validated);

        return redirect()->route('comprovantes.show', $comprovante)
            ->with('toast_success', 'Comprovante cadastrado com sucesso!');
    }

    public function show(Comprovante $comprovante)
    {
        return view('comprovantes.show', compact('comprovante'));
    }

    public function edit(Comprovante $comprovante)
    {
        return view('comprovantes.edit', [
            'comprovante' => $comprovante,
            'alunos' => Aluno::orderBy('nome')->get(),
            'documentos' => Documento::orderBy('nome')->get()
        ]);
    }

    public function update(Request $request, Comprovante $comprovante)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:500',
            'arquivo' => 'sometimes|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'data_emissao' => 'required|date|before_or_equal:today',
            'aluno_id' => 'required|exists:alunos,id',
            'documento_id' => 'required|exists:documentos,id'
        ]);

        // Atualiza arquivo se fornecido
        if ($request->hasFile('arquivo')) {
            // Remove arquivo antigo
            Storage::disk('public')->delete($comprovante->arquivo);
            
            // Salva novo arquivo
            $path = $request->file('arquivo')->store('comprovantes', 'public');
            $validated['arquivo'] = $path;
        }

        $comprovante->update($validated);

        return redirect()->route('comprovantes.show', $comprovante)
            ->with('toast_success', 'Comprovante atualizado com sucesso!');
    }

    public function destroy(Comprovante $comprovante)
    {
        // Remove arquivo físico
        Storage::disk('public')->delete($comprovante->arquivo);
        
        $comprovante->delete();

        return redirect()->route('comprovantes.index')
            ->with('toast_success', 'Comprovante movido para a lixeira!');
    }

    public function restore($id)
    {
        $comprovante = Comprovante::onlyTrashed()->findOrFail($id);
        $comprovante->restore();

        return redirect()->route('comprovantes.show', $comprovante)
            ->with('toast_success', 'Comprovante restaurado com sucesso!');
    }

    public function download(Comprovante $comprovante)
    {
        return Storage::disk('public')->download($comprovante->arquivo);
    }
}