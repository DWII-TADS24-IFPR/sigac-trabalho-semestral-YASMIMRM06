<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class StudentActivityController extends Controller
{
    public function index()
    {
        $activities = auth()->user()->activities()->latest()->get();
        return view('student.activities.index', compact('activities'));
    }

    public function create()
    {
        return view('student.activities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'hours' => 'required|numeric|min:1',
            'document' => 'required|file|mimes:pdf,jpg,png|max:2048'
        ]);

        $documentPath = $request->file('document')->store('documents');

        auth()->user()->activities()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'hours' => $validated['hours'],
            'document_path' => $documentPath,
            'status' => 'pending'
        ]);

        return redirect()->route('student.activities.index')
            ->with('success', 'Atividade cadastrada com sucesso!');
    }

    // Outros métodos (show, edit, update, destroy, etc.)
}