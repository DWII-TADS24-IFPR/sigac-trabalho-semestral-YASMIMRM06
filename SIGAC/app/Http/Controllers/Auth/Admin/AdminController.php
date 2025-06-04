<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Dashboard administrativo
     */
    public function dashboard()
    {
        $totalStudents = User::where('role', 'student')->count();
        $totalActivities = Activity::count();
        $pendingActivities = Activity::where('status', 'pending')->count();
        
        return view('admin.dashboard', compact('totalStudents', 'totalActivities', 'pendingActivities'));
    }

    /**
     * Gerenciar estudantes
     */
    public function manageStudents()
    {
        $students = User::where('role', 'student')
                    ->withCount(['activities', 'activities as pending_activities_count' => function($query) {
                        $query->where('status', 'pending');
                    }])
                    ->paginate(10);
        
        return view('admin.students.index', compact('students'));
    }

    /**
     * Aprovar/rejeitar atividades
     */
    public function reviewActivities()
    {
        $activities = Activity::with('user')
                    ->where('status', 'pending')
                    ->paginate(10);
        
        return view('admin.activities.review', compact('activities'));
    }

    /**
     * Processar aprovação de atividade
     */
    public function approveActivity(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);
        $activity->update([
            'status' => 'approved',
            'feedback' => $request->feedback
        ]);
        
        return back()->with('success', 'Atividade aprovada com sucesso!');
    }

    /**
     * Rejeitar atividade
     */
    public function rejectActivity(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);
        $activity->update([
            'status' => 'rejected',
            'feedback' => $request->feedback
        ]);
        
        return back()->with('success', 'Atividade rejeitada com sucesso!');
    }
}