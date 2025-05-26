@extends('template')

@section('title', 'Cursos')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Cursos</h1>
        <a href="{{ route('cursos.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Novo Curso
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Duração</th>
                    <th>Nível</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cursos as $curso)
                    <tr>
                        <td>{{ $curso->id }}</td>
                        <td>{{ $curso->nome }}</td>
                        <td>{{ $curso->duracao }} meses</td>
                        <td>{{ $curso->nivel->nome ?? 'N/A' }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('cursos.show', $curso->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST">
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
                        <td colspan="5" class="text-center">Nenhum curso cadastrado</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $cursos->links() }}
    </div>
@endsection