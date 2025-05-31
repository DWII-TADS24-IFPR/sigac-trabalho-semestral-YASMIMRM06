<?php

namespace App\Http\Controllers;

use App\Models\Nivel;
use App\Http\Requests\NivelRequest;

class NivelController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(NivelRequest $request)
    {
        Nivel::create($request->validated());

        return redirect()->route('admin.niveis.index')->with('success', 'Nível criado com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NivelRequest $request, Nivel $nivel)
    {
        $nivel->update($request->validated());

        return redirect()->route('admin.niveis.index')->with('success', 'Nível atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nivel $nivel)
    {
        $nivel->delete();

        return redirect()->route('admin.niveis.index')->with('success', 'Nível deletado com sucesso!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.niveis.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Nivel $nivel)
    {
        return view('admin.niveis.edit', compact('nivel'));
    }

    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $niveis = Nivel::paginate(10);
        return view('admin.niveis.index', compact('niveis'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Nivel $nivel)
    {
        return view('niveis.show', compact('nivel'));
    }

    /**
     * Display a listing of the trashed resources.
     */
    public function trashed()
    {
        $niveis = Nivel::onlyTrashed()->get(); 
        return view('niveis.trashed', compact('niveis'));
    }

}
