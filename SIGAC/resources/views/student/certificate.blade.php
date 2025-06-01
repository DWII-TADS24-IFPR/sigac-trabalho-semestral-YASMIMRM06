@extends('layouts.student')

@section('title', 'Declaração de Horas')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Declaração de Horas Complementares</h1>
        <div>
            <button onclick="window.print()" class="d-none d-sm-inline-block btn btn-primary shadow-sm me-2">
                <i class="fas fa-print fa-sm text-white-50"></i> Imprimir
            </button>
            <a href="{{ route('student.dashboard') }}" class="d-none d-sm-inline-block btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Voltar
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Documento para impressão -->
                    <div id="certificate" class="p-4 border">
                        <div class="text-center mb-4">
                            <img src="{{ asset('images/ifpr-logo.png') }}" alt="IFPR" style="height: 80px;">
                            <h2 class="mt-3 mb-0">INSTITUTO FEDERAL DO PARANÁ</h2>
                            <h3 class="mb-0">Campus Paranaguá</h3>
                            <h4 class="mt-4 mb-0 text-uppercase">Declaração de Horas Complementares</h4>
                        </div>
                        
                        <div class="mt-5 mb-5">
                            <p class="text-justify">
                                Declaramos para os devidos fins que o(a) aluno(a) <strong>{{ Auth::user()->name }}</strong>, 
                                matriculado(a) no curso de <strong>Tecnologia em Análise e Desenvolvimento de Sistemas</strong>, 
                                cumpriu um total de <strong>{{ $totalApprovedHours }} horas</strong> em atividades complementares, 
                                conforme regulamento do curso.
                            </p>
                            
                            <p class="text-justify mt-4">
                                As atividades foram realizadas no período de <strong>{{ $firstActivityDate }}</strong> 
                                a <strong>{{ $lastActivityDate }}</strong>, estando devidamente registradas e aprovadas 
                                no Sistema de Gestão de Atividades Complementares (SIGAC) deste Instituto.
                            </p>
                        </div>
                        
                        <div class="mt-5 pt-5 text-center">
                            <p>Paranaguá, {{ now()->format('d \d\e F \d\e Y') }}</p>
                            
                            <div class="mt-5 pt-5">
                                <div class="d-inline-block mx-4">
                                    <p class="border-top pt-2">__________________________________</p>
                                    <p>Coordenação do Curso</p>
                                </div>
                                
                                <div class="d-inline-block mx-4">
                                    <p class="border-top pt-2">__________________________________</p>
                                    <p>Direção Geral</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Detalhes das atividades -->
                    <div class="mt-5">
                        <h5 class="font-weight-bold text-gray-800 mb-3">Detalhamento das Atividades Aprovadas</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Atividade</th>
                                        <th>Categoria</th>
                                        <th>Horas</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($approvedActivities as $activity)
                                    <tr>
                                        <td>{{ $activity->description }}</td>
                                        <td>{{ $activity->category->name }}</td>
                                        <td>{{ $activity->hours }}</td>
                                        <td>{{ $activity->activity_date->format('d/m/Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2" class="text-right">Total:</th>
                                        <th>{{ $totalApprovedHours }} horas</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #certificate, #certificate * {
            visibility: visible;
        }
        #certificate {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none !important;
        }
        .no-print {
            display: none !important;
        }
    }
</style>
@endsection