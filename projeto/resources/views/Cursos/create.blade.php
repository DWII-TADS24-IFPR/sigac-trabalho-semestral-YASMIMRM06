@extends('template')

@section('title', 'Novo Curso')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Novo Curso</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('cursos.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome do Curso</label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') }}">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" rows="3">{{ old('descricao') }}</textarea>
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="duracao" class="form-label">Duração (meses)</label>
                        <input type="number" class="form-control @error('duracao') is-invalid @enderror" id="duracao" name="duracao" value="{{ old('duracao') }}">
                        @error('duracao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="nivel_id" class="form-label">Nível</label>
                        <select class="form-select @error('nivel_id') is-invalid @enderror" id="nivel_id" name="nivel_id">
                            <option value="">Selecione um nível</option>
                            @foreach($niveis as $nivel)
                                <option value="{{ $nivel->id }}" @selected(old('nivel_id') == $nivel->id)>
                                    {{ $nivel->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('nivel_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection