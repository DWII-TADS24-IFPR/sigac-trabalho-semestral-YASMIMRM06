@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Alunos Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total de Alunos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $alunosCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <a href="{{ route('alunos.index') }}" class="small-box-footer mt-2">
                        Ver todos <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Cursos Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total de Cursos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $cursosCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <a href="{{ route('cursos.index') }}" class="small-box-footer mt-2">
                        Ver todos <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Turmas Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total de Turmas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $turmasCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <a href="{{ route('turmas.index') }}" class="small-box-footer mt-2">
                        Ver todos <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Comprovantes Pendentes Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Comprovantes Pendentes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $comprovantesPendentesCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-upload fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <a href="{{ route('comprovantes.index') }}" class="small-box-footer mt-2">
                        Ver todos <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Últimos Alunos -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Últimos Alunos Cadastrados</h6>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @forelse($ultimosAlunos as $aluno)
                        <a href="{{ route('alunos.show', $aluno->id) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{ $aluno->nome }}</h6>
                                <small>{{ $aluno->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1">Matrícula: {{ $aluno->matricula }}</p>
                            <small>CPF: {{ $aluno->cpf }}</small>
                        </a>
                        @empty
                        <div class="list-group-item">
                            Nenhum aluno cadastrado recentemente.
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Últimas Turmas -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Últimas Turmas Criadas</h6>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @forelse($ultimasTurmas as $turma)
                        <a href="{{ route('turmas.show', $turma->id) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{ $turma->nome }} ({{ $turma->codigo }})</h6>
                                <span class="badge bg-{{ $turma->status == 'ativa' ? 'success' : ($turma->status == 'concluida' ? 'secondary' : ($turma->status == 'cancelada' ? 'danger' : 'info') }}">
                                    {{ ucfirst($turma->status) }}
                                </span>
                            </div>
                            <p class="mb-1">{{ $turma->curso->nome }} - {{ $turma->ano }}/{{ $turma->semestre }}</p>
                            <small>Criada em: {{ $turma->created_at->format('d/m/Y') }}</small>
                        </a>
                        @empty
                        <div class="list-group-item">
                            Nenhuma turma criada recentemente.
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection