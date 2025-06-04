<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

use App\Http\Models\Categoria;
use App\Models\Activity;
use Illuminate\Http\Request;

class StudentActivityController extends Controller
{
    public function index()
    {
        $activities = auth()->user()->activities()
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        $totalHours = $activities->where('status', 'approved')
                        ->sum('hours');
        
        return view('student.activities.index', compact('activities', 'totalHours'));
    }

    public function create()
    {
        $categories = [ ];
        return view('student.activities.create')->with('categories');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'hours' => 'required|numeric|min:1',
            'document' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'category_id' => 'required|exists:categories,id'
        ]);

        $path = $request->file('document')->store('activities/documents');

        auth()->user()->activities()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'hours' => $validated['hours'],
            'document_path' => $path,
            'category_id' => $validated['category_id'],
            'status' => 'pending'
        ]);

        return redirect()->route('student.activities.index')
            ->with('success', 'Atividade submetida para avaliação!');
    }

    public function certificate()
    {
        $approvedActivities = auth()->user()->activities()
                                ->where('status', 'approved')
                                ->get();
        
        if ($approvedActivities->sum('hours') < 60) {
            return back()->with('error', 'Você não cumpriu as horas necessárias');
        }

        return view('student.activities.certificate', compact('approvedActivities'));
    }
}