@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <h2 class="mb-4">Avaliar Solicitações de Horas</h2>
    
    <div class="card shadow">
        <div class="card-header bg-warning">
            <h5 class="mb-0">Solicitações Pendentes</h5>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Aluno</th>
                            <th>Atividade</th>
                            <th>Horas</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingActivities as $activity)
                        <tr>
                            <td>{{ $activity->student->name }}</td>
                            <td>{{ $activity->category->name }}</td>
                            <td>{{ $activity->hours }}</td>
                            <td>{{ $activity->activity_date->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ Storage::url($activity->document_path) }}" 
                                   class="btn btn-sm btn-info" target="_blank">
                                    <i class="fas fa-file-alt"></i> Ver Doc
                                </a>
                                <form method="POST" action="{{ route('admin.activities.update', $activity) }}" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fas fa-check"></i> Aprovar
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.activities.update', $activity) }}" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-times"></i> Rejeitar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection