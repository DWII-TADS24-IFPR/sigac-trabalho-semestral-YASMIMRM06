@extends('template')

@section('title', 'Detalhes do Nível')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Detalhes do Nível</h2>
                <div class="btn-group">
                    <a href="{{ route('niveis.edit', $nivel->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <form action="{{ route('niveis.destroy', $nivel->id) }}" method="POST">
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
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>ID:</strong> {{ $nivel->id }}
                </li>
                <li class="list-group-item">
                    <strong>Nome:</strong> {{ $nivel->nome }}
                </li>
                <li class="list-group-item">
                    <strong>Descrição:</strong> {{ $nivel->descricao }}
                </li>
                <li class="list-group-item">
                    <strong>Data de Criação:</strong> {{ $nivel->created_at->format('d/m/Y H:i') }}
                </li>
            </ul>
            
            <div class="mt-4">
                <h5>Cursos deste Nível</h5>
                @if($nivel->cursos->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Duração</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($nivel->cursos as $curso)
                                    <tr>
                                        <td>{{ $curso->nome }}</td>
                                        <td>{{ $curso->duracao }} meses</td>
                                        <td>
                                            <a href="{{ route('cursos.show', $curso->id) }}" class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">Nenhum curso associado a este nível.</div>
                @endif
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('niveis.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Voltar para lista
            </a>
        </div>
    </div>
@endsection