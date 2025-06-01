@extends('layouts.student')

@section('title', 'Detalhes da Atividade')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detalhes da Atividade Complementar</h1>
        <a href="{{ route('student.activities.index') }}" class="d-none d-sm-inline-block btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Voltar
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Informações da Atividade</h6>
            <span class="badge bg-{{ $activity->status == 'approved' ? 'success' : ($activity->status == 'rejected' ? 'danger' : 'warning') }}">
                {{ $activity->status == 'approved' ? 'Aprovado' : ($activity->status == 'rejected' ? 'Rejeitado' : 'Pendente') }}
            </span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <h5 class="font-weight-bold text-gray-800">Descrição</h5>
                        <p>{{ $activity->description }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="font-weight-bold text-gray-800">Categoria</h5>
                        <p>{{ $activity->category->name }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="font-weight-bold text-gray-800">Data da Atividade</h5>
                        <p>{{ $activity->activity_date->format('d/m/Y') }}</p>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-4">
                        <h5 class="font-weight-bold text-gray-800">Horas Solicitadas</h5>
                        <p>{{ $activity->hours }} hora(s)</p>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="font-weight-bold text-gray-800">Data de Envio</h5>
                        <p>{{ $activity->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="font-weight-bold text-gray-800">Documento Comprobatório</h5>
                        <a href="{{ Storage::url($activity->document_path) }}" 
                           target="_blank" 
                           class="btn btn-sm btn-primary">
                            <i class="fas fa-file-download me-2"></i> Visualizar Documento
                        </a>
                    </div>
                </div>
            </div>
            
            @if($activity->status == 'rejected' && $activity->feedback)
            <div class="alert alert-danger mt-4">
                <h5 class="alert-heading">Feedback da Rejeição</h5>
                <p>{{ $activity->feedback }}</p>
                @if($activity->updated_at)
                    <p class="mb-0"><small>Data da avaliação: {{ $activity->updated_at->format('d/m/Y H:i') }}</small></p>
                @endif
            </div>
            @elseif($activity->status == 'approved')
            <div class="alert alert-success mt-4">
                <h5 class="alert-heading">Atividade Aprovada</h5>
                <p class="mb-0">Sua atividade foi aprovada em {{ $activity->updated_at->format('d/m/Y H:i') }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection