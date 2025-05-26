@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Níveis</h1>
        <a href="{{ route('niveis.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Nível
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($niveis as $nivel)
                    <tr>
                        <td>{{ $nivel->nome }}</td>
                        <td>{{ Str::limit($nivel->descricao, 50) }}</td>
                        <td>
                            <span class="badge bg-{{ $nivel->ativo ? 'success' : 'secondary' }}">
                                {{ $nivel->ativo ? 'Ativo' : 'Inativo' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('niveis.edit', $nivel->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('niveis.destroy', $nivel->id) }}" method="POST" class="d-inline">
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
                {{ $niveis->links() }}
            </div>
        </div>
    </div>
</div>
@endsection