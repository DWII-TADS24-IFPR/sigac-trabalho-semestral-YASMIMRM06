@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Detalhes da Declaração</h1>
        <div>
            <a href="{{ route('declaracoes.edit', $declaracao->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
            <form action="{{ route('declaracoes.destroy', $declaracao->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">
                    <i class="fas fa-trash"></i> Excluir
                </button>
            </form>
            <a href="{{ route('declaracoes.download', $declaracao->id) }}" class="btn btn-primary">
                <i class="fas fa-download"></i> Baixar
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Informações Básicas</h5>
                    <p><strong>Aluno:</strong> {{ $declaracao->aluno->nome }} ({{ $declaracao->aluno->matricula }})</p>
                    <p><strong>Tipo:</strong> {{ ucfirst($declaracao->tipo) }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge bg-{{ $declaracao->status == 'emitida' ? 'success' : ($declaracao->status == 'cancelada' ? 'danger' : 'warning') }}">
                            {{ ucfirst($declaracao->status) }}
                        </span>
                    </p>
                </div>
                <div class="col-md-6">
                    <h5>Detalhes</h5>
                    <p><strong>Data de Solicitação:</strong> {{ $declaracao->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Data de Emissão:</strong> 
                        @if($declaracao->data_emissao)
                            {{ \Carbon\Carbon::parse($declaracao->data_emissao)->format('d/m/Y') }}
                        @else
                            --
                        @endif
                    </p>
                    <p><strong>Código:</strong> {{ $declaracao->codigo }}</p>
                </div>
            </div>

            <div class="mt-4">
                <h5>Conteúdo da Declaração</h5>
                <div class="p-3 border rounded bg-light">
                    {!! $declaracao->conteudo !!}
                </div>
            </div>

            <div class="mt-4">
                <h5>Observações</h5>
                <p>{{ $declaracao->observacoes ?? 'Nenhuma observação cadastrada.' }}</p>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('declaracoes.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>
</div>
@endsection