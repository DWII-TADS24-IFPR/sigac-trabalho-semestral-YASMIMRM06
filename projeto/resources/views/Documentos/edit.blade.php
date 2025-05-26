@extends('template')

@section('title', 'Editar Documento')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Editar Documento: {{ $documento->tipo }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('documentos.update', $documento->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <input type="text" class="form-control @error('tipo') is-invalid @enderror" id="tipo" name="tipo" value="{{ old('tipo', $documento->tipo) }}">
                        @error('tipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="pendente" @selected(old('status', $documento->status) == 'pendente')>Pendente</option>
                            <option value="aprovado" @selected(old('status', $documento->status) == 'aprovado')>Aprovado</option>
                            <option value="rejeitado" @selected(old('status', $documento->status) == 'rejeitado')>Rejeitado</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="aluno_id" class="form-label">Aluno</label>
                        <select class="form-select @error('aluno_id') is-invalid @enderror" id="aluno_id" name="aluno_id">
                            <option value="">Selecione um aluno</option>
                            @foreach($alunos as $aluno)
                                <option value="{{ $aluno->id }}" @selected(old('aluno_id', $documento->aluno_id) == $aluno->id)>
                                    {{ $aluno->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('aluno_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="categoria_id" class="form-label">Categoria</label>
                        <select class="form-select @error('categoria_id') is-invalid @enderror" id="categoria_id" name="categoria_id">
                            <option value="">Selecione uma categoria</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" @selected(old('categoria_id', $documento->categoria_id) == $categoria->id)>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('categoria_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="arquivo" class="form-label">Arquivo</label>
                    <input type="file" class="form-control @error('arquivo') is-invalid @enderror" id="arquivo" name="arquivo">
                    @error('arquivo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if($documento->caminho_arquivo)
                        <div class="mt-2">
                            <small>Arquivo atual: <a href="{{ asset('storage/' . $documento->caminho_arquivo) }}" target="_blank">Visualizar</a></small>
                        </div>
                    @endif
                </div>
                
                <div class="mb-3">
                    <label for="observacoes" class="form-label">Observações</label>
                    <textarea class="form-control @error('observacoes') is-invalid @enderror" id="observacoes" name="observacoes" rows="3">{{ old('observacoes', $documento->observacoes) }}</textarea>
                    @error('observacoes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="{{ route('documentos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection