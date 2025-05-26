@extends('template')

@section('title', 'Níveis')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Níveis</h1>
        <a href="{{ route('niveis.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Novo Nível
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Cursos</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($niveis as $nivel)
                    <tr>
                        <td>{{ $nivel->id }}</td>
                        <td>{{ $nivel->nome }}</td>
                        <td>{{ Str::limit($nivel->descricao, 50) }}</td>
                        <td>{{ $nivel->cursos_count }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('niveis.show', $nivel->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('niveis.edit', $nivel->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('niveis.destroy', $nivel->id) }}" method="POST">
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
                        <td colspan="5" class="text-center">Nenhum nível cadastrado</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $niveis->links() }}
    </div>
@endsection