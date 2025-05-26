@extends('template')

@section('title', 'Detalhes do Aluno')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Detalhes do Aluno</h2>
                <div class="btn-group">
                    <a href="{{ route('alunos.edit', $aluno->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <form action="{{ route('alunos.destroy', $aluno->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza?')">
                            <i class="bi bi-trash"></i> Excluir
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Informações Pessoais</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>ID:</strong> {{ $aluno->id }}
                        </li>
                        <li class="list-group-item">
                            <strong>Nome:</strong> {{ $aluno->nome }}
                        </li>
                        <li class="list-group-item">
                            <strong>Email:</strong> {{ $aluno->email }}
                        </li>
                        <li class="list-group-item">
                            <strong>CPF:</strong> {{ $aluno->cpf }}
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5>Informações Acadêmicas</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Turma:</strong> {{ $aluno->turma->nome ?? 'N/A' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Curso:</strong> {{ $aluno->turma->curso->nome ?? 'N/A' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Data de Cadastro:</strong> {{ $aluno->created_at->format('d/m/Y H:i') }}
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-4">
                <h5>Documentos do Aluno</h5>
                @if($aluno->documentos->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Data</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($aluno->documentos as $documento)
                                    <tr>
                                        <td>{{ $documento->tipo }}</td>
                                        <td>{{ $documento->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $documento->status === 'aprovado' ? 'success' : ($documento->status === 'pendente' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($documento->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('documentos.show', $documento->id) }}" class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">Nenhum documento cadastrado para este aluno.</div>
                @endif
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('alunos.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Voltar para lista
            </a>
        </div>
    </div>
@endsection