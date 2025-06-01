@extends('layouts.admin')

@section('title', 'Detalhes do Aluno')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detalhes do Aluno</h1>
        <div>
            <a href="{{ route('admin.students.edit', $student->id) }}" class="d-none d-sm-inline-block btn btn-warning shadow-sm me-2">
                <i class="fas fa-edit fa-sm text-white-50"></i> Editar
            </a>
            <a href="{{ route('admin.students.index') }}" class="d-none d-sm-inline-block btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Voltar
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informações Pessoais</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img class="img-profile rounded-circle" src="https://ui-avatars.com/api/?name={{ urlencode($student->name) }}&background=random" style="width: 150px; height: 150px;">
                    </div>
                    
                    <h4 class="text-center mb-4">{{ $student->name }}</h4>
                    
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Matrícula</h6>
                        <p>{{ $student->registration }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="font-weight-bold">E-mail</h6>
                        <p>{{ $student->email }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Status</h6>
                        <p>
                            @if($student->active)
                                <span class="badge bg-success">Ativo</span>
                            @else
                                <span class="badge bg-secondary">Inativo</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Informações Acadêmicas</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="font-weight-bold">Curso</h6>
                            <p>{{ $student->course->name ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="font-weight-bold">Turma</h6>
                            <p>{{ $student->class->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h6 class="font-weight-bold">Horas Complementares</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Aprovadas</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $student->approved_hours }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    Pendentes</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $student->pending_hours }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-clock fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Necessárias</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $student->required_hours }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-bullseye fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Progresso</h6>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-success" role="progressbar" 
                                 style="width: {{ $student->progress }}%" 
                                 aria-valuenow="{{ $student->progress }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100"></div>
                        </div>
                        <p class="text-center">{{ $student->progress }}% completo</p>
                    </div>
                </div>
            </div>
            
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Últimas Atividades</h6>
                    <a href="{{ route('admin.activities.index', ['student' => $student->id]) }}" class="btn btn-sm btn-primary">Ver Todas</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Atividade</th>
                                    <th>Horas</th>
                                    <th>Status</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($activities as $activity)
                                <tr>
                                    <td>{{ Str::limit($activity->description, 30) }}</td>
                                    <td>{{ $activity->hours }}</td>
                                    <td>
                                        @if($activity->status == 'approved')
                                            <span class="badge bg-success">Aprovado</span>
                                        @elseif($activity->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pendente</span>
                                        @else
                                            <span class="badge bg-danger">Rejeitado</span>
                                        @endif
                                    </td>
                                    <td>{{ $activity->created_at->format('d/m/Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Nenhuma atividade registrada</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection