@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Comprovantes</h1>
        <a href="{{ route('comprovantes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Comprovante
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Aluno</th>
                        <th>Documento</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comprovantes as $comprovante)
                    <tr>
                        <td>{{ $comprovante->aluno->nome }}</td>
                        <td>{{ $comprovante->documento->nome }}</td>
                        <td>{{ $comprovante->created_at->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $comprovante->status == 'aprovado' ? 'success' : ($comprovante->status == 'rejeitado' ? 'danger' : 'warning') }}">
                                {{ ucfirst($comprovante->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('comprovantes.edit', $comprovante->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('comprovantes.destroy', $comprovante->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <a href="{{ route('comprovantes.show', $comprovante->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="d-flex justify-content-center">
                {{ $comprovantes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection