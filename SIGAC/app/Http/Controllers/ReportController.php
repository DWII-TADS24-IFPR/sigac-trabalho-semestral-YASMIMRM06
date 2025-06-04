<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Exibir lista de relatórios
     */
    public function index()
    {
        $reports = Report::where('user_id', Auth::id())->get();
        return view('student.reports.index', compact('reports'));
    }

    /**
     * Exibir formulário de criação
     */
    public function create()
    {
        return view('student.reports.create');
    }

    /**
     * Armazenar novo relatório
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'type' => 'required|in:mensal,bimestral,semestral'
        ]);

        Report::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'type' => $validated['type'],
            'user_id' => Auth::id()
        ]);

        return redirect()->route('student.reports.index')
               ->with('success', 'Relatório cadastrado com sucesso!');
    }

    /**
     * Exibir relatório específico
     */
    public function show(Report $report)
    {
        $this->authorize('view', $report);
        return view('student.reports.show', compact('report'));
    }

    /**
     * Remover relatório
     */
    public function destroy(Report $report)
    {
        $this->authorize('delete', $report);
        $report->delete();
        
        return back()->with('success', 'Relatório removido com sucesso!');
    }
}