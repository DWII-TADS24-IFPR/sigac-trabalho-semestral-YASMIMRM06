@extends('layouts.admin')

@section('title', 'Gerenciar Cursos')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gerenciamento de Cursos</h1>
        <button class="d-none d-sm-inline-block btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addCourseModal">
            <i class="fas fa-plus fa-sm text-white-50"></i> Adicionar Curso
        </button>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Cursos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered data-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Código</th>
                            <th>Nível</th>
                            <th>Carga Horária</th>
                            <th>Horas Complementares</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->code }}</td>
                            <td>{{ $course->level }}</td>
                            <td>{{ $course->workload }}h</td>
                            <td>{{ $course->complementary_hours }}h</td>
                            <td>
                                @if($course->active)
                                    <span class="badge bg-success">Ativo</span>
                                @else
                                    <span class="badge bg-secondary">Inativo</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-course" 
                                        data-id="{{ $course->id }}"
                                        data-name="{{ $course->name }}"
                                        data-code="{{ $course->code }}"
                                        data-level="{{ $course->level }}"
                                        data-workload="{{ $course->workload }}"
                                        data-hours="{{ $course->complementary_hours }}"
                                        data-active="{{ $course->active }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.courses.destroy', $course->id) }}" 
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Tem certeza que deseja excluir este curso?');">
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

<!-- Modal Adicionar Curso -->
<div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCourseModalLabel">Adicionar Novo Curso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.courses.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome do Curso *</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="code" class="form-label">Código *</label>
                            <input type="text" class="form-control" id="code" name="code" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="level" class="form-label">Nível *</label>
                            <select class="form-select" id="level" name="level" required>
                                <option value="Técnico">Técnico</option>
                                <option value="Superior">Superior</option>
                                <option value="Pós-graduação">Pós-graduação</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="workload" class="form-label">Carga Horária Total *</label>
                            <input type="number" class="form-control" id="workload" name="workload" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="complementary_hours" class="form-label">Horas Complementares *</label>
                            <input type="number" class="form-control" id="complementary_hours" name="complementary_hours" required>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="active" name="active" checked>
                        <label class="form-check-label" for="active">
                            Curso ativo
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

<!-- Modal Editar Curso -->
<div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="editCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCourseModalLabel">Editar Curso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCourseForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nome do Curso *</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_code" class="form-label">Código *</label>
                            <input type="text" class="form-control" id="edit_code" name="code" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_level" class="form-label">Nível *</label>
                            <select class="form-select" id="edit_level" name="level" required>
                                <option value="Técnico">Técnico</option>
                                <option value="Superior">Superior</option>
                                <option value="Pós-graduação">Pós-graduação</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_workload" class="form-label">Carga Horária Total *</label>
                            <input type="number" class="form-control" id="edit_workload" name="workload" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_complementary_hours" class="form-label">Horas Complementares *</label>
                            <input type="number" class="form-control" id="edit_complementary_hours" name="complementary_hours" required>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="edit_active" name="active">
                        <label class="form-check-label" for="edit_active">
                            Curso ativo
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
    // Abrir modal de edição com dados do curso
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-course');
        
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const courseId = this.getAttribute('data-id');
                const courseName = this.getAttribute('data-name');
                const courseCode = this.getAttribute('data-code');
                const courseLevel = this.getAttribute('data-level');
                const courseWorkload = this.getAttribute('data-workload');
                const courseHours = this.getAttribute('data-hours');
                const courseActive = this.getAttribute('data-active') === '1';
                
                document.getElementById('edit_name').value = courseName;
                document.getElementById('edit_code').value = courseCode;
                document.getElementById('edit_level').value = courseLevel;
                document.getElementById('edit_workload').value = courseWorkload;
                document.getElementById('edit_complementary_hours').value = courseHours;
                document.getElementById('edit_active').checked = courseActive;
                
                document.getElementById('editCourseForm').action = `/admin/courses/${courseId}`;
                
                const editModal = new bootstrap.Modal(document.getElementById('editCourseModal'));
                editModal.show();
            });
        });
    });
</script>
@endpush
@endsection