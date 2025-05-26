@extends('template')

@section('title', 'Detalhes da Categoria')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Detalhes da Categoria</h2>
                <div class="btn-group">
                    <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST">
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
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>ID:</strong> {{ $categoria->id }}
                </li>
                <li class="list-group-item">
                    <strong>Nome:</strong> {{ $categoria->nome }}
                </li>
                <li class="list-group-item">
                    <strong>Descrição:</strong> {{ $categoria->descricao }}
                </li>
                <li class="list-group-item">
                    <strong>Data de Criação:</strong> {{ $categoria->created_at->format('d/m/Y H:i') }}
                </li>
            </ul>
            
            <div class="mt-4">
                <h5>Documentos nesta Categoria</h5>
                @if($categoria->documentos->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Aluno</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categoria->documentos as $documento)
                                    <tr>
                                        <td>{{ $documento->tipo }}</td>
                                        <td>{{ $documento->aluno->nome ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $documento->status === 'aprovado' ? 'success' : ($documento->status === 'pendente' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($documento->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('documentos.show', $documento->id) }}" class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">Nenhum documento nesta categoria.</div>
                @endif
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Voltar para lista
            </a>
        </div>
    </div>
@endsection