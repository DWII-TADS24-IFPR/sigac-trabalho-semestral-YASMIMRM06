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
                            <label for="aluno_id">Aluno*</label>
                            <select class="form-control @error('aluno_id') is-invalid @enderror" 
                                    id="aluno_id" name="aluno_id" required>
                                <option value="">Selecione um aluno</option>
                                @foreach($alunos as $aluno)
                                    <option value="{{ $aluno->id }}" {{ old('aluno_id') == $aluno->id ? 'selected' : '' }}>
                                        {{ $aluno->nome }} ({{ $aluno->matricula }})
                                    </option>
                                @endforeach
                            </select>
                            @error('aluno_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="tipo">Tipo*</label>
                            <select class="form-control @error('tipo') is-invalid @enderror" 
                                    id="tipo" name="tipo" required>
                                <option value="matricula" {{ old('tipo') == 'matricula' ? 'selected' : '' }}>Matrícula</option>
                                <option value="frequencia" {{ old('tipo') == 'frequencia' ? 'selected' : '' }}>Frequência</option>
                                <option value="conclusao" {{ old('tipo') == 'conclusao' ? 'selected' : '' }}>Conclusão</option>
                                <option value="outra" {{ old('tipo') == 'outra' ? 'selected' : '' }}>Outra</option>
                            </select>
                            @error('tipo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status*</label>
                            <select class="form-control @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="pendente" {{ old('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                                <option value="emitida" {{ old('status') == 'emitida' ? 'selected' : '' }}>Emitida</option>
                                <option value="cancelada" {{ old('status') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="data_emissao">Data de Emissão</label>
                            <input type="date" class="form-control @error('data_emissao') is-invalid @enderror" 
                                   id="data_emissao" name="data_emissao" value="{{ old('data_emissao') }}">
                            @error('data_emissao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="observacoes">Observações</label>
                    <textarea class="form-control @error('observacoes') is-invalid @enderror" 
                              id="observacoes" name="observacoes" rows="3">{{ old('observacoes') }}</textarea>
                    @error('observacoes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Salvar
                </button>
                <a href="{{ route('declaracoes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
</div>
@endsection