@extends('layouts.admin')

@section('title', 'Avaliar Solicitação')

@section('main-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Detalhes da Solicitação</h6>
                    <span class="badge bg-{{ $activity->status == 'approved' ? 'success' : ($activity->status == 'rejected' ? 'danger' : 'warning') }}">
                        {{ $activity->status == 'approved' ? 'Aprovado' : ($activity->status == 'rejected' ? 'Rejeitado' : 'Pendente') }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="font-weight-bold">Aluno:</h6>
                            <p>{{ $activity->student->name }} ({{ $activity->student->registration }})</p>
                            
                            <h6 class="font-weight-bold mt-3">Descrição:</h6>
                            <p>{{ $activity->description }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="font-weight-bold">Categoria:</h6>
                            <p>{{ $activity->category->name }}</p>
                            
                            <h6 class="font-weight-bold mt-3">Horas Solicitadas:</h6>
                            <p>{{ $activity->hours }} horas</p>
                            
                            <h6 class="font-weight-bold mt-3">Data da Atividade:</h6>
                            <p>{{ $activity->activity_date->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    
                    <h6 class="font-weight-bold">Documento Comprobatório:</h6>
                    <div class="text-center mt-3">
                        <iframe src="{{ Storage::url($activity->document_path) }}" 
                                style="width: 100%; height: 500px; border: 1px solid #ddd;"></iframe>
                    </div>
                    <div class="mt-3">
                        <a href="{{ Storage::url($activity->document_path) }}" 
                           target="_blank" class="btn btn-primary">
                            <i class="fas fa-download me-2"></i> Baixar Documento
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Avaliação</h6>
                </div>
                <div class="card-body">
                    @if($activity->status != 'pending')
                    <div class="alert alert-{{ $activity->status == 'approved' ? 'success' : 'danger' }}">
                        <h6 class="alert-heading">Esta solicitação já foi {{ $activity->status == 'approved' ? 'aprovada' : 'rejeitada' }}</h6>
                        <p class="mb-0">Avaliado em: {{ $activity->reviewed_at->format('d/m/Y H:i') }}</p>
                        @if($activity->feedback)
                        <hr>
                        <p><strong>Feedback:</strong> {{ $activity->feedback }}</p>
                        @endif
                    </div>
                    @else
                    <form method="POST" action="{{ route('admin.activities.update', $activity->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="approved">Aprovar</option>
                                <option value="rejected">Rejeitar</option>
                            </select>
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="hours">Horas Aprovadas</label>
                            <input type="number" class="form-control" id="hours" name="hours" 
                                   value="{{ $activity->hours }}" min="0" step="0.5" required>
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="feedback">Feedback (Opcional)</label>
                            <textarea class="form-control" id="feedback" name="feedback" rows="3"></textarea>
                        </div>
                        
                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('admin.activities.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Voltar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check me-2"></i> Salvar Avaliação
                            </button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection