@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Minhas Atividades Complementares</h1>
        <a href="{{ route('activities.create') }}" class="btn btn-primary">
            Nova Atividade
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Data</th>
                        <th>Horas</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activities as $activity)
                    <tr>
                        <td>{{ $activity->title }}</td>
                        <td>{{ $activity->date->format('d/m/Y') }}</td>
                        <td>{{ $activity->hours }}</td>
                        <td>
                            <span class="badge bg-{{ $activity->status === 'approved' ? 'success' : ($activity->status === 'rejected' ? 'danger' : 'warning') }}">
                                {{ $activity->status === 'approved' ? 'Aprovado' : ($activity->status === 'rejected' ? 'Rejeitado' : 'Pendente') }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('activities.show', $activity) }}" class="btn btn-sm btn-info">
                                Ver
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if(auth()->user()->activities()->approved()->sum('hours') >= 120)
    <div class="mt-4">
        <a href="{{ route('certificate') }}" class="btn btn-success">
            Emitir Declaração de Horas
        </a>
    </div>
    @endif
</div>
@endsection