@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Detalhes do Nível</h1>
        <div>
            <a href="{{ route('niveis.edit', $nivel->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
            <form action="{{ route('niveis.destroy', $nivel->id) }}" method="POST" class="d-inline">
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
                    <h5>Informações Básicas</h5>
                    <p><strong>Nome:</strong> {{ $nivel->nome }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge bg-{{ $nivel->ativo ? 'success' : 'secondary' }}">
                            {{ $nivel->ativo ? 'Ativo' : 'Inativo' }}
                        </span>
                    </p>
                    <p><strong>Criado em:</strong> {{ $nivel->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Atualizado em:</strong> {{ $nivel->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <div class="mt-4">
                <h5>Descrição</h5>
                <p>{{ $nivel->descricao ?? 'Nenhuma descrição cadastrada.' }}</p>
            </div>

            <hr>

            <h5 class="mt-4">Cursos Relacionados</h5>
            @if($nivel->cursos->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sigla</th>
                                <th>Nome</th>
                                <th>Duração</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nivel->cursos as $curso)
                            <tr>
                                <td>{{ $curso->sigla }}</td>
                                <td>{{ $curso->nome }}</td>
                                <td>{{ $curso->duracao }} semestres</td>
                                <td>
                                    <span class="badge bg-{{ $curso->ativo ? 'success' : 'secondary' }}">
                                        {{ $curso->ativo ? 'Ativo' : 'Inativo' }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">Nenhum curso cadastrado para este nível.</div>
            @endif
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('niveis.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>
</div>
@endsection