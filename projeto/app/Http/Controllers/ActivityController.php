<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = auth()->user()->activities()->latest()->get();
        return view('activities.index', compact('activities'));
    }

    public function create()
    {
        return view('activities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'hours' => 'required|numeric|min:1',
            'date' => 'required|date',
            'document' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $documentPath = $request->file('document')->store('activities');

        Activity::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'hours' => $validated['hours'],
            'date' => $validated['date'],
            'document_path' => $documentPath,
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);

        return redirect()->route('activities.index')->with('success', 'Atividade submetida com sucesso!');
    }

    public function show(Activity $activity)
    {
        $this->authorize('view', $activity);
        return view('activities.show', compact('activity'));
    }

    public function updateStatus(Activity $activity, Request $request)
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
            'feedback' => 'nullable|string',
        ]);

        $activity->update([
            'status' => $validated['status'],
            'feedback' => $validated['feedback'],
            'validator_id' => auth()->id(),
            'validated_at' => now(),
        ]);

        return back()->with('success', 'Status atualizado!');
    }
}