@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Nova Turma</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('turmas.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nome">Nome*</label>
                            <input type="text" class="form-control @error('nome') is-invalid @enderror" 
                                   id="nome" name="nome" value="{{ old('nome') }}" required>
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="curso_id">Curso*</label>
                            <select class="form-control @error('curso_id') is-invalid @enderror" 
                                    id="curso_id" name="curso_id" required>
                                <option value="">Selecione um curso</option>
                                @foreach($cursos as $curso)
                                    <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                                        {{ $curso->nome }} ({{ $curso->sigla }})
                                    </option>
                                @endforeach
                            </select>
                            @error('curso_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="codigo">Código*</label>
                            <input type="text" class="form-control @error('codigo') is-invalid @enderror" 
                                   id="codigo" name="codigo" value="{{ old('codigo') }}" required>
                            @error('codigo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ano">Ano*</label>
                            <input type="number" class="form-control @error('ano') is-invalid @enderror" 
                                   id="ano" name="ano" value="{{ old('ano', date('Y')) }}" required>
                            @error('ano')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="semestre">Semestre*</label>
                            <select class="form-control @error('semestre') is-invalid @enderror" 
                                    id="semestre" name="semestre" required>
                                <option value="1" {{ old('semestre') == 1 ? 'selected' : '' }}>1º Semestre</option>
                                <option value="2" {{ old('semestre') == 2 ? 'selected' : '' }}>2º Semestre</option>
                            </select>
                            @error('semestre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="vagas">Vagas*</label>
                            <input type="number" class="form-control @error('vagas') is-invalid @enderror" 
                                   id="vagas" name="vagas" value="{{ old('vagas', 30) }}" required>
                            @error('vagas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="data_inicio">Data de Início*</label>
                            <input type="date" class="form-control @error('data_inicio') is-invalid @enderror" 
                                   id="data_inicio" name="data_inicio" value="{{ old('data_inicio') }}" required>
                            @error('data_inicio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="data_fim">Data de Término</label>
                            <input type="date" class="form-control @error('data_fim') is-invalid @enderror" 
                                   id="data_fim" name="data_fim" value="{{ old('data_fim') }}">
                            @error('data_fim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sala">Sala</label>
                            <input type="text" class="form-control @error('sala') is-invalid @enderror" 
                                   id="sala" name="sala" value="{{ old('sala') }}">
                            @error('sala')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="horario">Horário</label>
                            <input type="text" class="form-control @error('horario') is-invalid @enderror" 
                                   id="horario" name="horario" value="{{ old('horario') }}" placeholder="Ex: 19:00-22:30">
                            @error('horario')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="status">Status*</label>
                    <select class="form-control @error('status') is-invalid @enderror" 
                            id="status" name="status" required>
                        <option value="planejada" {{ old('status') == 'planejada' ? 'selected' : '' }}>Planejada</option>
                        <option value="ativa" {{ old('status') == 'ativa' ? 'selected' : '' }}>Ativa</option>
                        <option value="concluida" {{ old('status') == 'concluida' ? 'selected' : '' }}>Concluída</option>
                        <option value="cancelada" {{ old('status') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Salvar
                </button>
                <a href="{{ route('turmas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
</div>
@endsection