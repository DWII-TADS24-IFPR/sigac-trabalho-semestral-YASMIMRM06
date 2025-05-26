@extends('template')

@section('title', 'Nova Turma')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Nova Turma</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('turmas.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nome" class="form-label">Nome da Turma</label>
                        <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') }}">
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="ano" class="form-label">Ano</label>
                        <input type="number" class="form-control @error('ano') is-invalid @enderror" id="ano" name="ano" value="{{ old('ano') }}" min="2000" max="2100">
                        @error('ano')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="vagas" class="form-label">Vagas</label>
                        <input type="number" class="form-control @error('vagas') is-invalid @enderror" id="vagas" name="vagas" value="{{ old('vagas') }}" min="1">
                        @error('vagas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="curso_id" class="form-label">Curso</label>
                        <select class="form-select @error('curso_id') is-invalid @enderror" id="curso_id" name="curso_id">
                            <option value="">Selecione um curso</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id }}" @selected(old('curso_id') == $curso->id)>
                                    {{ $curso->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('curso_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" rows="3">{{ old('descricao') }}</textarea>
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{ route('turmas.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection