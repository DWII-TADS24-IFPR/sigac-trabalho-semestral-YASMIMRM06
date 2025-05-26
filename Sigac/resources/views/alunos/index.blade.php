@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Alunos</h1>
    
    <div class="mb-3">
        <a href="{{ route('alunos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Aluno
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Curso</th>
                        <th>Turma</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alunos as $aluno)
                    <tr>
                        <td>{{ $aluno->nome }}</td>
                        <td>{{ $aluno->cpf_formatado }}</td>
                        <td>{{ $aluno->email }}</td>
                        <td>{{ $aluno->curso->nome ?? '-' }}</td>
                        <td>{{ $aluno->turma->nome ?? '-' }}</td>
                        <td>
                            <a href="{{ route('alunos.show', $aluno->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('alunos.edit', $aluno->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $alunos->links() }}
    </div>
</div>
@endsection