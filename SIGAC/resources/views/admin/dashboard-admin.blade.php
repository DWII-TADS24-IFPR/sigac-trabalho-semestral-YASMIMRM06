@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Painel Administrativo</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card text-white bg-primary">
                                <div class="card-body">
                                    <h5 class="card-title">Alunos Cadastrados</h5>
                                    <p class="card-text display-4">{{ $totalStudents }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card text-white bg-success">
                                <div class="card-body">
                                    <h5 class="card-title">Atividades Pendentes</h5>
                                    <p class="card-text display-4">{{ $pendingActivities }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card text-white bg-info">
                                <div class="card-body">
                                    <h5 class="card-title">Horas Validadas</h5>
                                    <p class="card-text display-4">{{ $validatedHours }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('admin.students.index') }}" class="btn btn-outline-primary me-2">
                            Gerenciar Alunos
                        </a>
                        <a href="{{ route('admin.activities.index') }}" class="btn btn-outline-secondary me-2">
                            Ver Atividades
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-success">
                            Categorias
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection