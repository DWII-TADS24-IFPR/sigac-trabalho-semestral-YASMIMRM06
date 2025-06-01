@extends('layouts.student')

@section('title', 'Nova Atividade Complementar')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Solicitar Validação de Horas Complementares</h1>
        <a href="{{ route('student.activities.index') }}" class="d-none d-sm-inline-block btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Voltar
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulário de Solicitação</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('student.activities.store') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Categoria da Atividade <span class="text-danger">*</span></label>
                            <select class="form-select @error('category_id') is-invalid @enderror" 
                                    id="category_id" name="category_id" required>
                                <option value="">Selecione uma categoria...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                   value="{{ old('activity_date', date('Y-m-d')) }}" required>
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
                                   value="{{ old('hours') }}" required>
                            @error('hours')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="document" class="form-label">Documento Comprobatório <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('document') is-invalid @enderror" 
                                   id="document" name="document" accept=".pdf,.jpg,.jpeg,.png" required>
                            <small class="text-muted">Formatos aceitos: PDF, JPG, PNG (Tamanho máximo: 5MB)</small>
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
                              rows="4" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-2"></i> Enviar Solicitação
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Orientações</h6>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <h5 class="alert-heading">Atenção!</h5>
                <ul class="mb-0">
                    <li>Todas as atividades devem ser comprovadas com documentação válida</li>
                    <li>O prazo médio para análise é de 15 dias úteis</li>
                    <li>Atividades incompletas ou com documentação insuficiente serão rejeitadas</li>
                    <li>Você será notificado por e-mail sobre o status da sua solicitação</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection