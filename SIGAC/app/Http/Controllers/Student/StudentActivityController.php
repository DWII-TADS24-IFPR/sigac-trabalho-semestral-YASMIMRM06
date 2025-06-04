<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class StudentActivityController extends Controller
{
    /**
     * Listar todas as atividades do aluno
     */
    public function index()
    {
        $activities = Auth::user()->activities()->with('documents')->get();
        return view('student.activities.index', compact('activities'));
    }

    /**
     * Mostrar formulário para cadastrar nova atividade
     */
    public function create()
    {
        return view('student.activities.create');
    }

    /**
     * Salvar nova atividade
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'hours' => 'required|numeric|min:1',
            'date' => 'required|date',
            'document' => 'required|file|mimes:pdf,jpg,png|max:2048'
        ]);

        $activity = Auth::user()->activities()->create($request->except('document'));

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('documents');
            $activity->documents()->create([
                'path' => $path,
                'original_name' => $request->file('document')->getClientOriginalName()
            ]);
        }

        return redirect()->route('student.activities.index')
                         ->with('success', 'Atividade cadastrada com sucesso!');
    }

    /**
     * Mostrar detalhes de uma atividade
     */
    public function show(Activity $activity)
    {
        $this->authorize('view', $activity);
        return view('student.activities.show', compact('activity'));
    }
}