@extends('template')

@section('title', 'Documentos')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Documentos</h1>
        <a href="{{ route('documentos.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Novo Documento
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Aluno</th>
                    <th>Categoria</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($documentos as $documento)
                    <tr>
                        <td>{{ $documento->id }}</td>
                        <td>{{ $documento->tipo }}</td>
                        <td>{{ $documento->aluno->nome ?? 'N/A' }}</td>
                        <td>{{ $documento->categoria->nome ?? 'N/A' }}</td>
                        <td>
                            <span class="badge bg-{{ $documento->status === 'aprovado' ? 'success' : ($documento->status === 'pendente' ? 'warning' : 'danger') }}">
                                {{ ucfirst($documento->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('documentos.show', $documento->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('documentos.edit', $documento->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('documentos.destroy', $documento->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Nenhum documento cadastrado</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $documentos->links() }}
    </div>
@endsection