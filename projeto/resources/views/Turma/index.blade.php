@extends('template')

@section('title', 'Turmas')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Turmas</h1>
        <a href="{{ route('turmas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nova Turma
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ano</th>
                    <th>Curso</th>
                    <th>Vagas</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($turmas as $turma)
                    <tr>
                        <td>{{ $turma->id }}</td>
                        <td>{{ $turma->nome }}</td>
                        <td>{{ $turma->ano }}</td>
                        <td>{{ $turma->curso->nome ?? 'N/A' }}</td>
                        <td>{{ $turma->vagas }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('turmas.show', $turma->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('turmas.edit', $turma->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('turmas.destroy', $turma->id) }}" method="POST">
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
                        <td colspan="6" class="text-center">Nenhuma turma cadastrada</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $turmas->links() }}
    </div>
@endsection