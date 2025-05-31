<?php

namespace App\Http\Controllers;

use App\Models\Comprovante;
use App\Models\Aluno;
use App\Models\Categoria;
use App\Models\User;
use App\Http\Requests\ComprovanteRequest;

class ComprovanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comprovantes = Comprovante::all();
        return view('comprovantes.index', compact('comprovantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alunos = Aluno::all();
        $categorias = Categoria::all();
        $users = User::all();

        return view('comprovantes.create', compact('alunos', 'categorias', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComprovanteRequest $request)
    {
        Comprovante::create($request->validated());

        return redirect()->route('comprovantes.index')->with('success', 'Comprovante criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $comprovante = Comprovante::findOrFail($id);
        return view('comprovantes.show', compact('comprovante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $comprovante = Comprovante::findOrFail($id);
        $alunos = Aluno::all();
        $categorias = Categoria::all();
        $users = User::all();

        return view('comprovantes.edit', compact('comprovante', 'alunos', 'categorias', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComprovanteRequest $request, $id)
    {
        $comprovante = Comprovante::findOrFail($id);
        $comprovante->update($request->validated());

        return redirect()->route('comprovantes.index')->with('success', 'Comprovante atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comprovante = Comprovante::findOrFail($id);
        $comprovante->delete();

        return redirect()->route('comprovantes.index')->with('success', 'Comprovante excluído com sucesso.');
    }
}
