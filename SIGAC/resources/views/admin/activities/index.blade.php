@extends('layouts.admin')

@section('title', 'Solicitações de Atividades')

@section('main-content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Solicitações de Atividades Complementares</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" 
                     aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Opções:</div>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <i class="fas fa-filter me-2"></i>Filtrar
                    </a>
                    <a class="dropdown-item" href="{{ route('admin.activities.export') }}">
                        <i class="fas fa-file-export me-2"></i>Exportar
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Aluno</th>
                            <th>Matrícula</th>
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
                            <td>{{ $activity->student->name }}</td>
                            <td>{{ $activity->student->registration }}</td>
                            <td>{{ Str::limit($activity->description, 30) }}</td>
                            <td>{{ $activity->category->name }}</td>
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
                            <td>
                                <a href="{{ route('admin.activities.review', $activity->id) }}" 
                                   class="btn btn-sm btn-primary" title="Avaliar">
                                    <i class="fas fa-clipboard-check"></i>
                                </a>
                                <a href="{{ Storage::url($activity->document_path) }}" 
                                   target="_blank" class="btn btn-sm btn-info" title="Ver Documento">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $activities->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal de Filtro -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filtrar Solicitações</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="GET" action="{{ route('admin.activities.index') }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Todos</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pendentes</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Aprovadas</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejeitadas</option>
                        </select>
                    </div>
                    <div class="mb-3">
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
                    <div class="mb-3">
                        <label for="student" class="form-label">Aluno</label>
                        <select class="form-select" id="student" name="student">
                            <option value="">Todos</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ request('student') == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json'
            },
            responsive: true,
            dom: '<"top"f>rt<"bottom"lip><"clear">',
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50, 100],
            order: [[6, 'desc']]
        });
    });
</script>
@endpush