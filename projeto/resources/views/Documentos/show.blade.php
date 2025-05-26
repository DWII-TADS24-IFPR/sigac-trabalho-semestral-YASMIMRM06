@extends('template')

@section('title', 'Detalhes do Documento')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Detalhes do Documento</h2>
                <div class="btn-group">
                    <a href="{{ route('documentos.edit', $documento->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <form action="{{ route('documentos.destroy', $documento->id) }}" method="POST">
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
                    <h5>Informações do Documento</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>ID:</strong> {{ $documento->id }}
                        </li>
                        <li class="list-group-item">
                            <strong>Tipo:</strong> {{ $documento->tipo }}
                        </li>
                        <li class="list-group-item">
                            <strong>Status:</strong>
                            <span class="badge bg-{{ $documento->status === 'aprovado' ? 'success' : ($documento->status === 'pendente' ? 'warning' : 'danger') }}">
                                {{ ucfirst($documento->status) }}
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5>Vinculações</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Aluno:</strong> {{ $documento->aluno->nome ?? 'N/A' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Categoria:</strong> {{ $documento->categoria->nome ?? 'N/A' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Data de Envio:</strong> {{ $documento->created_at->format('d/m/Y H:i') }}
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-4">
                <h5>Arquivo</h5>
                @if($documento->caminho_arquivo)
                    <div class="mb-3">
                        <a href="{{ asset('storage/' . $documento->caminho_arquivo) }}" target="_blank" class="btn btn-primary">
                            <i class="bi bi-download"></i> Baixar Arquivo
                        </a>
                    </div>
                @else
                    <div class="alert alert-warning">Nenhum arquivo anexado.</div>
                @endif
                
                <div class="mb-3">
                    <label class="form-label"><strong>Observações:</strong></label>
                    <p>{{ $documento->observacoes ?? 'Nenhuma observação cadastrada.' }}</p>
                </div>
            </div>
            
            <div class="mt-4">
                <h5>Comprovantes Relacionados</h5>
                @if($documento->comprovantes->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Data</th>
                                    <th>Valor</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documento->comprovantes as $comprovante)
                                    <tr>
                                        <td>{{ $comprovante->tipo }}</td>
                                        <td>{{ $comprovante->data->format('d/m/Y') }}</td>
                                        <td>R$ {{ number_format($comprovante->valor, 2, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('comprovantes.show', $comprovante->id) }}" class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">Nenhum comprovante relacionado.</div>
                @endif
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('documentos.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Voltar para lista
            </a>
        </div>
    </div>
@endsection