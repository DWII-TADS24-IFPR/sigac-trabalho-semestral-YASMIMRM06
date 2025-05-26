@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Novo Documento</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="titulo">Título*</label>
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" 
                                   id="titulo" name="titulo" value="{{ old('titulo') }}" required>
                            @error('titulo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="aluno_id">Aluno*</label>
                            <select class="form-control @error('aluno_id') is-invalid @enderror" 
                                    id="aluno_id" name="aluno_id" required>
                                <option value="">Selecione um aluno</option>
                                @foreach($alunos as $aluno)
                                    <option value="{{ $aluno->id }}" {{ old('aluno_id') == $aluno->id ? 'selected' : '' }}>
                                        {{ $aluno->nome }} ({{ $aluno->curso->sigla }})
                                    </option>
                                @endforeach
                            </select>
                            @error('aluno_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="categoria_id">Categoria*</label>
                            <select class="form-control @error('categoria_id') is-invalid @enderror" 
                                    id="categoria_id" name="categoria_id" required>
                                <option value="">Selecione uma categoria</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categoria_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="horas_solicitadas">Horas Solicitadas*</label>
                            <input type="number" step="0.1" class="form-control @error('horas_solicitadas') is-invalid @enderror" 
                                   id="horas_solicitadas" name="horas_solicitadas" value="{{ old('horas_solicitadas') }}" required>
                            @error('horas_solicitadas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição*</label>
                    <textarea class="form-control @error('descricao') is-invalid @enderror" 
                              id="descricao" name="descricao" rows="3" required>{{ old('descricao') }}</textarea>
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="data_atividade">Data da Atividade*</label>
                            <input type="date" class="form-control @error('data_atividade') is-invalid @enderror" 
                                   id="data_atividade" name="data_atividade" value="{{ old('data_atividade') }}" required>
                            @error('data_atividade')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="arquivo">Arquivo* (PDF, JPG, PNG - Máx 2MB)</label>
                            <input type="file" class="form-control-file @error('arquivo') is-invalid @enderror" 
                                   id="arquivo" name="arquivo" required>
                            @error('arquivo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Enviar Documento
                </button>
                <a href="{{ route('documentos.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
</div>
@endsection