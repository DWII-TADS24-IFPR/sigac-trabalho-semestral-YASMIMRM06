<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Categoria;
use App\Models\User;
use App\Http\Requests\DocumentoRequest; 

class DocumentoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(DocumentoRequest $request) 
    {
        Documento::create($request->validated()); 

        return redirect()->route('documentos.index')->with('success', 'Documento criado com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DocumentoRequest $request, Documento $documento) 
    {
        $documento->update($request->validated()); 

        return redirect()->route('documentos.index')->with('success', 'Documento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documento $documento)
    {
        $documento->delete();

        return redirect()->route('documentos.index')->with('success', 'Documento excluído com sucesso!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();  
        $users = User::all();  
        return view('documentos.create', compact('categorias', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Documento $documento)
    {
        $categorias = Categoria::all();
        $users = User::all();  
        return view('documentos.edit', compact('documento', 'categorias', 'users'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentos = Documento::all();  
        return view('documentos.index', compact('documentos'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Documento $documento)
    {
        return view('documentos.show', compact('documento'));
    }
}
