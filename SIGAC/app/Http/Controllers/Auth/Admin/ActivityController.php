<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::with(['user', 'category'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
        
        return view('admin.activities.index', compact('activities'));
    }

    public function review(Activity $activity)
    {
        return view('admin.activities.review', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
            'feedback' => 'nullable|string|max:500'
        ]);

        $activity->update([
            'status' => $validated['status'],
            'feedback' => $validated['feedback'],
            'reviewed_at' => now(),
            'reviewed_by' => auth()->id()
        ]);

        return redirect()->route('admin.activities.index')
            ->with('success', 'Atividade avaliada com sucesso!');
    }
}