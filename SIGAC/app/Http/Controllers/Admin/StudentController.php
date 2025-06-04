<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Mostrar dashboard do estudante
     */
    public function dashboard()
    {
        $user = Auth::user();
        $totalHours = $user->activities()->sum('hours');
        $pendingActivities = $user->activities()->where('status', 'pending')->count();
        
        return view('student.dashboard', compact('user', 'totalHours', 'pendingActivities'));
    }

    /**
     * Listar atividades do estudante
     */
    public function activities()
    {
        $activities = Auth::user()->activities()
                        ->with('documents')
                        ->orderBy('date', 'desc')
                        ->get();
        
        return view('student.activities.index', compact('activities'));
    }

    /**
     * Mostrar formulário de nova atividade
     */
    public function createActivity()
    {
        return view('student.activities.create');
    }

    /**
     * Salvar nova atividade
     */
    public function storeActivity(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'hours' => 'required|numeric|min:1',
            'date' => 'required|date',
            'document' => 'required|file|mimes:pdf,jpg,png|max:2048'
        ]);

        $activity = Auth::user()->activities()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'hours' => $validated['hours'],
            'date' => $validated['date'],
            'status' => 'pending'
        ]);

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('documents');
            $activity->documents()->create([
                'path' => $path,
                'original_name' => $request->file('document')->getClientOriginalName()
            ]);
        }

        return redirect()->route('student.activities')
                         ->with('success', 'Atividade cadastrada com sucesso!');
    }
}