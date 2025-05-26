@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Nova Declaração</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('declaracoes.store') }}" method="POST">
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
                            <label for="comprovante_id">Comprovante (opcional)</label>
                            <select class="form-control @error('comprovante_id') is-invalid @enderror" 
                                    id="comprovante_id" name="comprovante_id">
                                <option value="">Nenhum comprovante vinculado</option>
                                @foreach($comprovantes as $comprovante)
                                    <option value="{{ $comprovante->id }}" {{ old('comprovante_id') == $comprovante->id ? 'selected' : '' }}>
                                        {{ $comprovante->titulo }} - {{ $comprovante->aluno->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('comprovante_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="data_emissao">Data de Emissão*</label>
                            <input type="datetime-local" class="form-control @error('data_emissao') is-invalid @enderror" 
                                   id="data_emissao" name="data_emissao" value="{{ old('data_emissao') }}" required>
                            @error('data_emissao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="conteudo">Conteúdo*</label>
                    <textarea class="form-control @error('conteudo') is-invalid @enderror" 
                              id="conteudo" name="conteudo" rows="10" required>{{ old('conteudo') }}</textarea>
                    @error('conteudo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição (opcional)</label>
                    <textarea class="form-control @error('descricao') is-invalid @enderror" 
                              id="descricao" name="descricao" rows="3">{{ old('descricao') }}</textarea>
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="modelo" name="modelo" value="1" {{ old('modelo') ? 'checked' : '' }}>
                    <label class="form-check-label" for="modelo">Salvar como modelo</label>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Salvar Declaração
                </button>
                <a href="{{ route('declaracoes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#conteudo',
        plugins: 'lists link image table code help wordcount',
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image | code',
        height: 500
    });
</script>
@endsection
@endsection