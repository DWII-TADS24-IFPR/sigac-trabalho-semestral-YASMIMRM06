@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Detalhes do Comprovante</h1>
        <div>
            <a href="{{ route('comprovantes.edit', $comprovante->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
            <form action="{{ route('comprovantes.destroy', $comprovante->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">
                    <i class="fas fa-trash"></i> Excluir
                </button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Informações Básicas</h5>
                    <p><strong>Aluno:</strong> {{ $comprovante->aluno->nome }} ({{ $comprovante->aluno->matricula }})</p>
                    <p><strong>Documento:</strong> {{ $comprovante->documento->nome }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge bg-{{ $comprovante->status == 'aprovado' ? 'success' : ($comprovante->status == 'rejeitado' ? 'danger' : 'warning') }}">
                            {{ ucfirst($comprovante->status) }}
                        </span>
                    </p>
                </div>
                <div class="col-md-6">
                    <h5>Detalhes</h5>
                    <p><strong>Data de Envio:</strong> {{ $comprovante->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Arquivo:</strong> 
                        @if($comprovante->caminho_arquivo)
                            <a href="{{ asset('storage/' . $comprovante->caminho_arquivo) }}" target="_blank" class="btn btn-sm btn-info">
                                <i class="fas fa-download"></i> Baixar
                            </a>
                        @else
                            Nenhum arquivo disponível
                        @endif
                    </p>
                </div>
            </div>

            <div class="mt-4">
                <h5>Observações</h5>
                <p>{{ $comprovante->observacoes ?? 'Nenhuma observação cadastrada.' }}</p>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('comprovantes.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>
</div>
@endsection