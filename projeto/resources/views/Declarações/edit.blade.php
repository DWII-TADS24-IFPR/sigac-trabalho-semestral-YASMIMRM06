@extends('template')

@section('title', 'Editar Declaração')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Editar Declaração: {{ $declaracao->tipo }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('declaracoes.update', $declaracao->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <input type="text" class="form-control @error('tipo') is-invalid @enderror" id="tipo" name="tipo" value="{{ old('tipo', $declaracao->tipo) }}">
                        @error('tipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="pendente" @selected(old('status', $declaracao->status) == 'pendente')>Pendente</option>
                            <option value="aprovado" @selected(old('status', $declaracao->status) == 'aprovado')>Aprovado</option>
                            <option value="rejeitado" @selected(old('status', $declaracao->status) == 'rejeitado')>Rejeitado</option>
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
                                <option value="{{ $aluno->id }}" @selected(old('aluno_id', $declaracao->aluno_id) == $aluno->id)>
                                    {{ $aluno->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('aluno_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="data" class="form-label">Data</label>
                        <input type="date" class="form-control @error('data') is-invalid @enderror" id="data" name="data" value="{{ old('data', $declaracao->data->format('Y-m-d')) }}">
                        @error('data')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="conteudo" class="form-label">Conteúdo</label>
                    <textarea class="form-control @error('conteudo') is-invalid @enderror" id="conteudo" name="conteudo" rows="5">{{ old('conteudo', $declaracao->conteudo) }}</textarea>
                    @error('conteudo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="{{ route('declaracoes.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection