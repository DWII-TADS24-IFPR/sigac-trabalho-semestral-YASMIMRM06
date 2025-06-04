<?php
namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Activity;
use App\Models\Course;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingActivities = Activity::where('status', 'pending')->count();
        $studentsCount = User::where('role_id', 2)->count();
        $courses = Course::withCount('students')->get();
        
        return view('admin.dashboard', compact('pendingActivities', 'studentsCount', 'courses'));
    }

    public function reports()
    {
        $courses = Course::with(['students' => function($query) {
            $query->withSum(['activities' => function($query) {
                $query->where('status', 'approved');
            }], 'hours');
        }])->get();

        return view('admin.reports.index', compact('courses'));
    }
}