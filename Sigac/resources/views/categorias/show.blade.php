@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Detalhes da Categoria</h1>
        <div>
            <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="d-inline">
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
                    <p><strong>Nome:</strong> {{ $categoria->nome }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge bg-{{ $categoria->ativo ? 'success' : 'secondary' }}">
                            {{ $categoria->ativo ? 'Ativo' : 'Inativo' }}
                        </span>
                    </p>
                    <p><strong>Criado em:</strong> {{ $categoria->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Atualizado em:</strong> {{ $categoria->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <div class="mt-4">
                <h5>Descrição</h5>
                <p>{{ $categoria->descricao ?? 'Nenhuma descrição cadastrada.' }}</p>
            </div>

            <hr>

            <h5 class="mt-4">Documentos Relacionados</h5>
            @if($categoria->documentos->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Obrigatório</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categoria->documentos as $documento)
                            <tr>
                                <td>{{ $documento->nome }}</td>
                                <td>
                                    <span class="badge bg-{{ $documento->obrigatorio ? 'success' : 'secondary' }}">
                                        {{ $documento->obrigatorio ? 'Sim' : 'Não' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $documento->ativo ? 'success' : 'secondary' }}">
                                        {{ $documento->ativo ? 'Ativo' : 'Inativo' }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">Nenhum documento cadastrado nesta categoria.</div>
            @endif
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>
</div>
@endsection