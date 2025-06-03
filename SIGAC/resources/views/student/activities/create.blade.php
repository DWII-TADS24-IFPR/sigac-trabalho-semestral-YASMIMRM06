@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Solicitar Validação de Horas Complementares</h2>
    
    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Nova Atividade</h5>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('student.activities.store') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Categoria da Atividade</label>
                    <select class="form-select" name="category_id" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Descrição da Atividade</label>
                    <textarea class="form-control" name="description" rows="3" required></textarea>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Data da Atividade</label>
                        <input type="date" class="form-control" name="activity_date" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Horas Solicitadas</label>
                        <input type="number" class="form-control" name="hours" min="1" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Documento Comprobatório</label>
                    <input type="file" class="form-control" name="document" accept=".pdf,.jpg,.png" required>
                    <small class="text-muted">Formatos aceitos: PDF, JPG, PNG (Máx. 2MB)</small>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-2"></i> Enviar Solicitação
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection