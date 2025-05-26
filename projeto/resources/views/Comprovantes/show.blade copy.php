@extends('template')

@section('title', 'Detalhes do Comprovante')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Detalhes do Comprovante</h2>
                <div class="btn-group">
                    <a href="{{ route('comprovantes.edit', $comprovante->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <form action="{{ route('comprovantes.destroy', $comprovante->id) }}" method="POST">
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
                    <h5>Informações do Comprovante</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>ID:</strong> {{ $comprovante->id }}
                        </li>
                        <li class="list-group-item">
                            <strong>Tipo:</strong> {{ $comprovante->tipo }}
                        </li>
                        <li class="list-group-item">
                            <strong>Data:</strong> {{ $comprovante->data->format('d/m/Y') }}
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5>Valores</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Valor:</strong> R$ {{ number_format($comprovante->valor, 2, ',', '.') }}
                        </li>
                        <li class="list-group-item">
                            <strong>Documento:</strong> 
                            @if($comprovante->documento)
                                <a href="{{ route('documentos.show', $comprovante->documento_id) }}">
                                    {{ $comprovante->documento->tipo }}
                                </a>
                            @else
                                N/A
                            @endif
                        </li>
                        <li class="list-group-item">
                            <strong>Aluno:</strong> 
                            @if($comprovante->documento && $comprovante->documento->aluno)
                                <a href="{{ route('alunos.show', $comprovante->documento->aluno_id) }}">
                                    {{ $comprovante->documento->aluno->nome }}
                                </a>
                            @else
                                N/A
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-4">
                <h5>Descrição</h5>
                <p>{{ $comprovante->descricao ?? 'Nenhuma descrição cadastrada.' }}</p>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('comprovantes.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Voltar para lista
            </a>
        </div>
    </div>
@endsection