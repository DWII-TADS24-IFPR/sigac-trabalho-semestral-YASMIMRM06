@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Detalhes do Aluno</h1>
        <div>
            <a href="{{ route('alunos.edit', $aluno->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
            <form action="{{ route('alunos.destroy', $aluno->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">
                    <i class="fas fa-trash"></i> Excluir
                </button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Informações Pessoais</h5>
                    <p><strong>Nome:</strong> {{ $aluno->nome }}</p>
                    <p><strong>CPF:</strong> {{ $aluno->cpf }}</p>
                    <p><strong>Data de Nascimento:</strong> {{ \Carbon\Carbon::parse($aluno->data_nascimento)->format('d/m/Y') }}</p>
                    <p><strong>Matrícula:</strong> {{ $aluno->matricula }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge bg-{{ $aluno->ativo ? 'success' : 'secondary' }}">
                            {{ $aluno->ativo ? 'Ativo' : 'Inativo' }}
                        </span>
                    </p>
                </div>
                <div class="col-md-6">
                    <h5>Contato</h5>
                    <p><strong>Email:</strong> {{ $aluno->email }}</p>
                    <p><strong>Telefone:</strong> {{ $aluno->telefone ?? '--' }}</p>
                    <p><strong>Celular:</strong> {{ $aluno->celular ?? '--' }}</p>
                    <p><strong>Endereço:</strong> {{ $aluno->endereco ?? '--' }}</p>
                </div>
            </div>

            <hr>

            <h5 class="mt-4">Turmas Matriculadas</h5>
            @if($aluno->turmas->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Turma</th>
                                <th>Curso</th>
                                <th>Ano/Semestre</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aluno->turmas as $turma)
                            <tr>
                                <td>{{ $turma->nome }} ({{ $turma->codigo }})</td>
                                <td>{{ $turma->curso->nome }}</td>
                                <td>{{ $turma->ano }}/{{ $turma->semestre }}</td>
                                <td>
                                    <span class="badge bg-{{ $turma->pivot->ativo ? 'success' : 'secondary' }}">
                                        {{ $turma->pivot->ativo ? 'Ativo' : 'Inativo' }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">O aluno não está matriculado em nenhuma turma.</div>
            @endif

            <hr>

            <h5 class="mt-4">Documentos Entregues</h5>
            @if($aluno->comprovantes->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Documento</th>
                                <th>Data</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aluno->comprovantes as $comprovante)
                            <tr>
                                <td>{{ $comprovante->documento->nome }}</td>
                                <td>{{ $comprovante->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $comprovante->status == 'aprovado' ? 'success' : ($comprovante->status == 'rejeitado' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($comprovante->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">Nenhum documento entregue.</div>
            @endif
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('alunos.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>
</div>
@endsection