@extends('layouts.admin')

@section('title', 'Gerenciar Turmas')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gerenciamento de Turmas</h1>
        <button class="d-none d-sm-inline-block btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addClassModal">
            <i class="fas fa-plus fa-sm text-white-50"></i> Adicionar Turma
        </button>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Turmas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered data-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Curso</th>
                            <th>Ano</th>
                            <th>Semestre</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($classes as $class)
                        <tr>
                            <td>{{ $class->name }}</td>
                            <td>{{ $class->course->name ?? 'N/A' }}</td>
                            <td>{{ $class->year }}</td>
                            <td>{{ $class->semester }}º</td>
                            <td>
                                @if($class->active)
                                    <span class="badge bg-success">Ativa</span>
                                @else
                                    <span class="badge bg-secondary">Inativa</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-class" 
                                        data-id="{{ $class->id }}"
                                        data-name="{{ $class->name }}"
                                        data-course_id="{{ $class->course_id }}"
                                        data-year="{{ $class->year }}"
                                        data-semester="{{ $class->semester }}"
                                        data-active="{{ $class->active }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.classes.destroy', $class->id) }}" 
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Tem certeza que deseja excluir esta turma?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
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

<!-- Modal Adicionar Turma -->
<div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClassModalLabel">Adicionar Nova Turma</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.classes.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome da Turma *</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="course_id" class="form-label">Curso *</label>
                        <select class="form-select" id="course_id" name="course_id" required>
                            <option value="">Selecione um curso...</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="year" class="form-label">Ano *</label>
                            <input type="number" class="form-control" id="year" name="year" 
                                   min="{{ date('Y') - 5 }}" max="{{ date('Y') + 5 }}" 
                                   value="{{ date('Y') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="semester" class="form-label">Semestre *</label>
                            <select class="form-select" id="semester" name="semester" required>
                                <option value="1">1º Semestre</option>
                                <option value="2">2º Semestre</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="active" name="active" checked>
                        <label class="form-check-label" for="active">
                            Turma ativa
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Turma -->
<div class="modal fade" id="editClassModal" tabindex="-1" aria-labelledby="editClassModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editClassModalLabel">Editar Turma</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editClassForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nome da Turma *</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_course_id" class="form-label">Curso *</label>
                        <select class="form-select" id="edit_course_id" name="course_id" required>
                            <option value="">Selecione um curso...</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_year" class="form-label">Ano *</label>
                            <input type="number" class="form-control" id="edit_year" name="year" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_semester" class="form-label">Semestre *</label>
                            <select class="form-select" id="edit_semester" name="semester" required>
                                <option value="1">1º Semestre</option>
                                <option value="2">2º Semestre</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="edit_active" name="active">
                        <label class="form-check-label" for="edit_active">
                            Turma ativa
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Abrir modal de edição com dados da turma
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-class');
        
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const classId = this.getAttribute('data-id');
                const className = this.getAttribute('data-name');
                const classCourseId = this.getAttribute('data-course_id');
                const classYear = this.getAttribute('data-year');
                const classSemester = this.getAttribute('data-semester');
                const classActive = this.getAttribute('data-active') === '1';
                
                document.getElementById('edit_name').value = className;
                document.getElementById('edit_course_id').value = classCourseId;
                document.getElementById('edit_year').value = classYear;
                document.getElementById('edit_semester').value = classSemester;
                document.getElementById('edit_active').checked = classActive;
                
                document.getElementById('editClassForm').action = `/admin/classes/${classId}`;
                
                const editModal = new bootstrap.Modal(document.getElementById('editClassModal'));
                editModal.show();
            });
        });
    });
</script>
@endpush
@endsection