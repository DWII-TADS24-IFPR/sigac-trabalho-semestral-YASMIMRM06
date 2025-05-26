@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Curso</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('cursos.update', $curso->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nome">Nome*</label>
                            <input type="text" class="form-control @error('nome') is-invalid @enderror" 
                                   id="nome" name="nome" value="{{ old('nome', $curso->nome) }}" required>
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="sigla">Sigla*</label>
                            <input type="text" class="form-control @error('sigla') is-invalid @enderror" 
                                   id="sigla" name="sigla" value="{{ old('sigla', $curso->sigla) }}" required>
                            @error('sigla')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="nivel_id">Nível*</label>
                            <select class="form-control @error('nivel_id') is-invalid @enderror" 
                                    id="nivel_id" name="nivel_id" required>
                                <option value="">Selecione um nível</option>
                                @foreach($niveis as $nivel)
                                    <option value="{{ $nivel->id }}" {{ (old('nivel_id', $curso->nivel_id) == $nivel->id) ? 'selected' : '' }}>
                                        {{ $nivel->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nivel_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="duracao">Duração (semestres)*</label>
                            <input type="number" class="form-control @error('duracao') is-invalid @enderror" 
                                   id="duracao" name="duracao" value="{{ old('duracao', $curso->duracao) }}" required>
                            @error('duracao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="modalidade">Modalidade*</label>
                            <select class="form-control @error('modalidade') is-invalid @enderror" 
                                    id="modalidade" name="modalidade" required>
                                <option value="presencial" {{ old('modalidade', $curso->modalidade) == 'presencial' ? 'selected' : '' }}>Presencial</option>
                                <option value="ead" {{ old('modalidade', $curso->modalidade) == 'ead' ? 'selected' : '' }}>EAD</option>
                                <option value="hibrido" {{ old('modalidade', $curso->modalidade) == 'hibrido' ? 'selected' : '' }}>Híbrido</option>
                            </select>
                            @error('modalidade')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="ativo" name="ativo" 
                                       value="1" {{ old('ativo', $curso->ativo) ? 'checked' : '' }}>
                                <label class="form-check-label" for="ativo">
                                    Ativo
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea class="form-control @error('descricao') is-invalid @enderror" 
                              id="descricao" name="descricao" rows="3">{{ old('descricao', $curso->descricao) }}</textarea>
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Atualizar
                </button>
                <a href="{{ route('cursos.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
</div>
@endsection