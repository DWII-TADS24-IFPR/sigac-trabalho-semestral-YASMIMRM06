@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Declarações</h1>
        <a href="{{ route('declaracoes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nova Declaração
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Aluno</th>
                        <th>Tipo</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($declaracoes as $declaracao)
                    <tr>
                        <td>{{ $declaracao->aluno->nome }}</td>
                        <td>{{ $declaracao->tipo }}</td>
                        <td>{{ $declaracao->created_at->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $declaracao->status == 'emitida' ? 'success' : ($declaracao->status == 'cancelada' ? 'danger' : 'warning') }}">
                                {{ ucfirst($declaracao->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('declaracoes.edit', $declaracao->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('declaracoes.destroy', $declaracao->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <a href="{{ route('declaracoes.show', $declaracao->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="d-flex justify-content-center">
                {{ $declaracoes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection