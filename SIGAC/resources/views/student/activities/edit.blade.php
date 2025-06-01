@extends('layouts.student')

@section('title', 'Editar Atividade')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Editar Solicitação de Horas Complementares</h1>
        <a href="{{ route('student.activities.index') }}" class="d-none d-sm-inline-block btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Voltar
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Editar Solicitação</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('student.activities.update', $activity->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Categoria da Atividade <span class="text-danger">*</span></label>
                            <select class="form-select @error('category_id') is-invalid @enderror" 
                                    id="category_id" name="category_id" required>
                                <option value="">Selecione uma categoria...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $activity->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="activity_date" class="form-label">Data da Atividade <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('activity_date') is-invalid @enderror" 
                                   id="activity_date" name="activity_date" 
                                   value="{{ old('activity_date', $activity->activity_date->format('Y-m-d')) }}" required>
                            @error('activity_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="hours" class="form-label">Quantidade de Horas <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('hours') is-invalid @enderror" 
                                   id="hours" name="hours" min="1" 
                                   value="{{ old('hours', $activity->hours) }}" required>
                            @error('hours')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="document" class="form-label">Novo Documento Comprobatório</label>
                            <input type="file" class="form-control @error('document') is-invalid @enderror" 
                                   id="document" name="document" accept=".pdf,.jpg,.jpeg,.png">
                            <small class="text-muted">Deixe em branco para manter o documento atual</small>
                            @error('document')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Descrição da Atividade <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" 
                              rows="4" required>{{ old('description', $activity->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                        <i class="fas fa-trash-alt me-2"></i> Excluir Solicitação
                    </button>
                    
                    <div>
                        <a href="{{ route('student.activities.index') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-times me-2"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Salvar Alterações
                        </button>
                    </div>
                </div>
            </form>
            
            <form id="deleteForm" action="{{ route('student.activities.destroy', $activity->id) }}" method="POST" class="d-none">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete() {
        if (confirm('Tem certeza que deseja excluir esta solicitação? Esta ação não pode ser desfeita.')) {
            document.getElementById('deleteForm').submit();
        }
    }
</script>
@endpush