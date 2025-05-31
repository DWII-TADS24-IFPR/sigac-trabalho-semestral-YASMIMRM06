<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;
use App\Models\Curso;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::with('curso')->get();
        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
     public function create()
    {
        $cursos = Curso::all();
        return view('admin.categorias.create', compact('cursos'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriaRequest $request)
    {
        Categoria::create($request->validated());

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        return view('admin.categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Categoria $categoria)
    {
        $cursos = Curso::all();
        return view('admin.categorias.edit', compact('categoria', 'cursos'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaRequest $request, Categoria $categoria)
    {
        $categoria->update($request->validated());

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria excluída com sucesso!');
    }
}
