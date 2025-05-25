<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Turma;
use App\Models\Documento;
use App\Models\Comprovante;
use App\Models\Declaracao;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'alunos' => Aluno::count(),
            'cursos' => Curso::count(),
            'turmas' => Turma::count(),
            'documentos' => Documento::count(),
            'comprovantes' => Comprovante::count(),
            'declaracoes' => Declaracao::count()
        ];

        $recentes = [
            'alunos' => Aluno::with(['curso'])
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get(),
            'documentos' => Documento::with(['aluno'])
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get(),
            'comprovantes' => Comprovante::with(['aluno'])
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get()
        ];

        return view('home', compact('stats', 'recentes'));
    }
}