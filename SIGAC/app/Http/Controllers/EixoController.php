<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eixo;
use App\Http\Requests\EixoRequest;

class EixoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
      public function index()
    {
        $eixos = Eixo::paginate(10);
        return view('admin.eixos.index', compact('eixos'));
    }

    /**
     * Show the form for creating a new resource.
     */
     public function create()
    {
        return view('admin.eixos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(EixoRequest $request)
    {
        Eixo::create($request->validated());

        return redirect()->route('admin.eixos.index')->with('success', 'Eixo criado com sucesso!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Eixo $eixo)
    {
        return view('admin.eixos.edit', compact('eixo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EixoRequest $request, Eixo $eixo)
    {
        $eixo->update($request->validated());

        return redirect()->route('admin.eixos.index')->with('success', 'Eixo atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(Eixo $eixo)
    {
        $eixo->delete();

        return redirect()->route('admin.eixos.index')->with('success', 'Eixo deletado com sucesso!');
    }
}
