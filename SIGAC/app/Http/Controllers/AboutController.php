<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Exibe a página "Sobre o Sistema"
     */
    public function index()
    {
        return view('about', [
            'title' => 'Sobre o SIGAC',
            'description' => 'Sistema de Gerenciamento de Atividades Complementares',
            'version' => '1.0.0',
            'features' => [
                'Gerenciamento de atividades complementares',
                'Acompanhamento de horas por alunos',
                'Relatórios administrativos'
            ]
        ]);
    }
}