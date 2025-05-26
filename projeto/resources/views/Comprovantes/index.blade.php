@extends('template')

@section('title', 'Comprovantes')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Comprovantes</h1>
        <a href="{{ route('comprovantes.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Novo Comprovante
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Documento</th>
                    <th>Data</th>
                    <th>Valor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($comprovantes as $comprovante)
                    <tr>
                        <td>{{ $comprovante->id }}</td>
                        <td>{{ $comprovante->tipo }}</td>
                        <td>{{ $comprovante->documento->tipo ?? 'N/A' }}</td>
                        <td>{{ $comprovante->data->format('d/m/Y') }}</td>
                        <td>R$ {{ number_format($comprovante->valor, 2, ',', '.') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('comprovantes.show', $comprovante->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('comprovantes.edit', $comprovante->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('comprovantes.destroy', $comprovante->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Nenhum comprovante cadastrado</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $comprovantes->links() }}
    </div>
@endsection