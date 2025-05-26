@extends('layouts.app')

@section('title', 'Alunos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2">Alunos</h1>
    <a href="{{ route('alunos.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Novo Aluno
    </a>
</div>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h5 class="mb-0">Lista de Alunos</h5>
            </div>
            <div class="col-md-6">
                <form action="{{ route('alunos.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Buscar aluno..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-primary">Buscar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Curso</th>
                        <th>Turma</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alunos as $aluno)
                    <tr>
                        <td>{{ $aluno->id }}</td>
                        <td>{{ $aluno->nome }}</td>
                        <td>{{ substr($aluno->cpf, 0, 3) . '.' . substr($aluno->cpf, 3, 3) . '.' . substr($aluno->cpf, 6, 3) . '-' . substr($aluno->cpf, 9, 2) }}</td>
                        <td>{{ $aluno->email }}</td>
                        <td>{{ $aluno->curso->nome ?? 'N/A' }}</td>
                        <td>{{ $aluno->turma->nome ?? 'N/A' }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('alunos.show', $aluno->id) }}" class="btn btn-sm btn-info text-white" title="Visualizar">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('alunos.edit', $aluno->id) }}" class="btn btn-sm btn-warning text-white" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('alunos.destroy', $aluno->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este aluno?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Excluir">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Nenhum aluno encontrado.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                Exibindo {{ $alunos->count() }} de {{ $alunos->total() }} alunos
            </div>
            <div>
                {{ $alunos->links() }}
            </div>
        </div>
    </div>
</div>
@endsection