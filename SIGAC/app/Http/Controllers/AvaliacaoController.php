<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;

class AvaliacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $solicitacoes = Documento::with(['user.aluno', 'categoria'])
            ->where('status', 'pendente')
            ->paginate(10);

        return view('admin.avaliacoes.index', compact('solicitacoes'));
    }

    public function aprovar(Request $request, $id)
    {
        $request->validate([
            'horas_out' => 'required|numeric|min:0.1',
        ]);

        $solicitacao = Documento::findOrFail($id);
        $solicitacao->status = 'aprovado';
        $solicitacao->horas_out = $request->horas_out;
        $solicitacao->comentario = null;
        $solicitacao->save();

        return redirect()->route('admin.avaliacoes.index')->with('success', 'Solicitação aprovada com sucesso!');
    }

    public function rejeitar(Request $request, $id)
    {
        $request->validate([
            'comentario' => 'required|string|max:1000',
        ]);

        $solicitacao = Documento::findOrFail($id);
        $solicitacao->status = 'rejeitado';
        $solicitacao->comentario = $request->comentario;
        $solicitacao->save();

        return redirect()->route('admin.avaliacoes.index')->with('success', 'Solicitação rejeitada com sucesso!');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $solicitacao = Documento::with(['user.aluno', 'categoria'])->findOrFail($id);

        return view('admin.avaliacoes.show', compact('solicitacao'));
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
