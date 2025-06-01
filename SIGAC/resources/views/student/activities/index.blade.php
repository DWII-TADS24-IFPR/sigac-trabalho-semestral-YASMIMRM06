@extends('layouts.student')

@section('title', 'Minhas Atividades')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Minhas Atividades Complementares</h1>
        <a href="{{ route('student.activities.create') }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle fa-sm text-white-50"></i> Nova Atividade
        </a>
    </div>

    <!-- Filtros -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filtrar Atividades</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('student.activities.index') }}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Todos</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pendentes</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Aprovadas</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejeitadas</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="category" class="form-label">Categoria</label>
                        <select class="form-select" id="category" name="category">
                            <option value="">Todas</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-filter"></i> Filtrar
                    </button>
                    <a href="{{ route('student.activities.index') }}" class="btn btn-secondary">
                        <i class="fas fa-sync-alt"></i> Limpar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Lista de Atividades -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Atividades Registradas</h6>
            <div>
                <span class="me-2">Total de Horas: <strong>{{ $totalFilteredHours }}</strong></span>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Categoria</th>
                            <th>Horas</th>
                            <th>Status</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activities as $activity)
                        <tr>
                            <td>{{ Str::limit($activity->description, 40) }}</td>
                            <td>{{ $activity->category->name }}</td>
                            <td>{{ $activity->hours }}</td>
                            <td>
                                @if($activity->status == 'approved')
                                    <span class="badge bg-success">Aprovado</span>
                                @elseif($activity->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pendente</span>
                                @else
                                    <span class="badge bg-danger">Rejeitado</span>
                                    @if($activity->feedback)
                                        <i class="fas fa-info-circle text-danger ms-1" 
                                           data-bs-toggle="tooltip" 
                                           title="{{ $activity->feedback }}"></i>
                                    @endif
                                @endif
                            </td>
                            <td>{{ $activity->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('student.activities.show', $activity->id) }}" 
                                   class="btn btn-sm btn-primary" 
                                   title="Visualizar">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($activity->status == 'pending')
                                <a href="{{ route('student.activities.edit', $activity->id) }}" 
                                   class="btn btn-sm btn-warning" 
                                   title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Nenhuma atividade encontrada</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Paginação -->
            <div class="d-flex justify-content-center mt-4">
                {{ $activities->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Inicializar tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush