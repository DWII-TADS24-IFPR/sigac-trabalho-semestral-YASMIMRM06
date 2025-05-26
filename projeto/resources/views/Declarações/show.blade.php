@extends('template')

@section('title', 'Detalhes da Declaração')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Detalhes da Declaração</h2>
                <div class="btn-group">
                    <a href="{{ route('declaracoes.edit', $declaracao->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <form action="{{ route('declaracoes.destroy', $declaracao->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza?')">
                            <i class="bi bi-trash"></i> Excluir
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Informações da Declaração</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>ID:</strong> {{ $declaracao->id }}
                        </li>
                        <li class="list-group-item">
                            <strong>Tipo:</strong> {{ $declaracao->tipo }}
                        </li>
                        <li class="list-group-item">
                            <strong>Status:</strong>
                            <span class="badge bg-{{ $declaracao->status === 'aprovado' ? 'success' : ($declaracao->status === 'pendente' ? 'warning' : 'danger') }}">
                                {{ ucfirst($declaracao->status) }}
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5>Vinculações</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Aluno:</strong> 
                            @if($declaracao->aluno)
                                <a href="{{ route('alunos.show', $declaracao->aluno_id) }}">
                                    {{ $declaracao->aluno->nome }}
                                </a>
                            @else
                                N/A
                            @endif
                        </li>
                        <li class="list-group-item">
                            <strong>Data:</strong> {{ $declaracao->data->format('d/m/Y') }}
                        </li>
                        <li class="list-group-item">
                            <strong>Emitido em:</strong> {{ $declaracao->created_at->format('d/m/Y H:i') }}
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-4">
                <h5>Conteúdo</h5>
                <div class="p-3 bg-light rounded">
                    {!! nl2br(e($declaracao->conteudo)) !!}
                </div>
            </div>
            
            <div class="mt-4">
                <a href="{{ route('declaracoes.download', $declaracao->id) }}" class="btn btn-primary">
                    <i class="bi bi-download"></i> Baixar Declaração
                </a>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('declaracoes.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Voltar para lista
            </a>
        </div>
    </div>
@endsection