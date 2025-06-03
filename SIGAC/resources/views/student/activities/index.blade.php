@extends('layouts.app')

@section('title', 'Minhas Atividades')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Minhas Atividades Complementares</h5>
                    <div>
                        <span class="badge bg-primary">Total de Horas: {{ $totalHours }}</span>
                        <a href="{{ route('student.activities.create') }}" class="btn btn-sm btn-success ms-2">
                            Nova Atividade
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Atividade</th>
                                    <th>Categoria</th>
                                    <th>Horas</th>
                                    <th>Status</th>
                                    <th>Data</th>
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
                                        <span class="badge bg-{{ $activity->status_color }}">
                                            {{ $activity->status_text }}
                                        </span>
                                    </td>
                                    <td>{{ $activity->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('student.activities.show', $activity) }}" class="btn btn-sm btn-info">
                                            Detalhes
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($totalHours >= 60)
                    <div class="mt-4 text-center">
                        <a href="{{ route('student.certificate') }}" class="btn btn-primary">
                            Emitir Declaração de Conclusão
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection