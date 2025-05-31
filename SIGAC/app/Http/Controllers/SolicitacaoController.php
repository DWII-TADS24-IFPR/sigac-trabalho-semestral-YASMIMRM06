<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SolicitacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $solicitacoes = Documento::where('user_id', Auth::id())
            ->with('categoria')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('aluno.solicitacoes.index', compact('solicitacoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('aluno.solicitacoes.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'atividade' => 'required|string|max:255',
            'descricao' => 'required|string',
            'horas_in' => 'required|numeric|min:0.5',
            'categoria_id' => 'required|exists:categorias,id',
            'arquivo' => 'required|file|mimes:pdf|max:2048',
        ]);

        $path = $request->file('arquivo')->store('comprovantes', 'public');

        Documento::create([
            'atividade' => $request->atividade,
            'descricao' => $request->descricao,
            'horas_in' => $request->horas_in,
            'categoria_id' => $request->categoria_id,
            'user_id' => Auth::id(),
            'status' => 'pendente',
            'url' => $path,
        ]);

        return redirect()->route('aluno.solicitacoes.index')->with('success', 'Solicitação enviada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $solicitacao = Documento::where('user_id', Auth::id())
            ->with('categoria')
            ->findOrFail($id);

        return view('aluno.solicitacoes.show', compact('solicitacao'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
