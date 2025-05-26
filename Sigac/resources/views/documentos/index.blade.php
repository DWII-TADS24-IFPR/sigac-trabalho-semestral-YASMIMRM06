@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Documentos</h1>
        <a href="{{ route('documentos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Documento
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Obrigatório</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documentos as $documento)
                    <tr>
                        <td>{{ $documento->nome }}</td>
                        <td>{{ $documento->categoria->nome }}</td>
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
                        <td>
                            <a href="{{ route('documentos.edit', $documento->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('documentos.destroy', $documento->id) }}" method="POST" class="d-inline">
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
                {{ $documentos->links() }}
            </div>
        </div>
    </div>
</div>
@endsection