@extends('template')

@section('title', 'Detalhes do Curso')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Detalhes do Curso</h2>
                <div class="btn-group">
                    <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST">
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
                    <h5>Informações Básicas</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>ID:</strong> {{ $curso->id }}
                        </li>
                        <li class="list-group-item">
                            <strong>Nome:</strong> {{ $curso->nome }}
                        </li>
                        <li class="list-group-item">
                            <strong>Duração:</strong> {{ $curso->duracao }} meses
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5>Classificação</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Nível:</strong> {{ $curso->nivel->nome ?? 'N/A' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Descrição:</strong> {{ $curso->descricao }}
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-4">
                <h5>Turmas deste Curso</h5>
                @if($curso->turmas->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Ano</th>
                                    <th>Vagas</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($curso->turmas as $turma)
                                    <tr>
                                        <td>{{ $turma->nome }}</td>
                                        <td>{{ $turma->ano }}</td>
                                        <td>{{ $turma->vagas }}</td>
                                        <td>
                                            <a href="{{ route('turmas.show', $turma->id) }}" class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">Nenhuma turma cadastrada para este curso.</div>
                @endif
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('cursos.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Voltar para lista
            </a>
        </div>
    </div>
@endsection