@extends('template')

@section('title', 'Declarações')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Declarações</h1>
        <a href="{{ route('declaracoes.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nova Declaração
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Aluno</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($declaracoes as $declaracao)
                    <tr>
                        <td>{{ $declaracao->id }}</td>
                        <td>{{ $declaracao->tipo }}</td>
                        <td>{{ $declaracao->aluno->nome ?? 'N/A' }}</td>
                        <td>{{ $declaracao->data->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $declaracao->status === 'aprovado' ? 'success' : ($declaracao->status === 'pendente' ? 'warning' : 'danger') }}">
                                {{ ucfirst($declaracao->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('declaracoes.show', $declaracao->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('declaracoes.edit', $declaracao->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('declaracoes.destroy', $declaracao->id) }}" method="POST">
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
                        <td colspan="6" class="text-center">Nenhuma declaração cadastrada</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $declaracoes->links() }}
    </div>
@endsection