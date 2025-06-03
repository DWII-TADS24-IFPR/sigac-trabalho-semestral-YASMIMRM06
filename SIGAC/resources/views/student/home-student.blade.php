@extends('layouts.student')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Minhas Atividades Complementares</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Horas Validadas</h5>
                                    <p class="card-text display-4">{{ $validatedHours }}h</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Horas Pendentes</h5>
                                    <p class="card-text display-4">{{ $pendingHours }}h</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <h4>Minhas Atividades</h4>
                        <a href="{{ route('student.activities.create') }}" class="btn btn-primary">
                            Nova Atividade
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Atividade</th>
                                    <th>Categoria</th>
                                    <th>Horas</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activities as $activity)
                                <tr>
                                    <td>{{ $activity->title }}</td>
                                    <td>{{ $activity->category->name }}</td>
                                    <td>{{ $activity->hours }}</td>
                                    <td>
                                        <span class="badge bg-{{ $activity->status === 'approved' ? 'success' : ($activity->status === 'rejected' ? 'danger' : 'warning') }}">
                                            {{ $activity->status === 'approved' ? 'Aprovado' : ($activity->status === 'rejected' ? 'Rejeitado' : 'Pendente') }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('student.activities.show', $activity->id) }}" class="btn btn-sm btn-info">Ver</a>
                                        <a href="{{ route('student.activities.edit', $activity->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection