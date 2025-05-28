<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Course;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pendingCount = Activity::pending()->count();
        $studentsCount = User::where('is_admin', false)->count();
        $courses = Course::withCount(['users', 'activities'])->get();

        return view('admin.dashboard', compact('pendingCount', 'studentsCount', 'courses'));
    }

    public function activities()
    {
        $activities = Activity::with(['user', 'validator'])->latest()->paginate(10);
        return view('admin.activities', compact('activities'));
    }

    public function students()
    {
        $students = User::with(['course', 'activities'])
            ->where('is_admin', false)
            ->latest()
            ->paginate(10);

        return view('admin.students', compact('students'));
    }
}