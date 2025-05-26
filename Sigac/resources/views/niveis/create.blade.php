@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Novo Nível</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('niveis.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="nome">Nome*</label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" 
                           id="nome" name="nome" value="{{ old('nome') }}" required>
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea class="form-control @error('descricao') is-invalid @enderror" 
                              id="descricao" name="descricao" rows="3">{{ old('descricao') }}</textarea>
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ordem">Ordem*</label>
                            <input type="number" class="form-control @error('ordem') is-invalid @enderror" 
                                   id="ordem" name="ordem" value="{{ old('ordem') }}" required>
                            @error('ordem')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="icone">Ícone (Font Awesome)</label>
                            <input type="text" class="form-control @error('icone') is-invalid @enderror" 
                                   id="icone" name="icone" value="{{ old('icone') }}" placeholder="Ex: fa-graduation-cap">
                            @error('icone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1" checked>
                    <label class="form-check-label" for="ativo">Ativo</label>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Salvar
                </button>
                <a href="{{ route('niveis.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
</div>
@endsection