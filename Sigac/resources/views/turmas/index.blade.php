@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Turmas</h1>
        <a href="{{ route('turmas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nova Turma
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Curso</th>
                        <th>Ano/Semestre</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($turmas as $turma)
                    <tr>
                        <td>{{ $turma->codigo }}</td>
                        <td>{{ $turma->nome }}</td>
                        <td>{{ $turma->curso->sigla }}</td>
                        <td>{{ $turma->ano }}/{{ $turma->semestre }}</td>
                        <td>
                            <span class="badge bg-{{ $turma->status == 'ativa' ? 'success' : ($turma->status == 'concluida' ? 'secondary' : ($turma->status == 'cancelada' ? 'danger' : 'info')) }}">
                                {{ ucfirst($turma->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('turmas.edit', $turma->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('turmas.destroy', $turma->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="d-flex justify-content-center">
                {{ $turmas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection