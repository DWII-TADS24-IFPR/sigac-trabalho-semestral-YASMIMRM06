@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Novo Comprovante</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('comprovantes.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="documento_id">Documento*</label>
                            <select class="form-control @error('documento_id') is-invalid @enderror" 
                                    id="documento_id" name="documento_id" required>
                                <option value="">Selecione um documento</option>
                                @foreach($documentos as $documento)
                                    <option value="{{ $documento->id }}" {{ old('documento_id') == $documento->id ? 'selected' : '' }}>
                                        {{ $documento->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('documento_id')
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
                                <option value="aprovado" {{ old('status') == 'aprovado' ? 'selected' : '' }}>Aprovado</option>
                                <option value="rejeitado" {{ old('status') == 'rejeitado' ? 'selected' : '' }}>Rejeitado</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="arquivo">Arquivo*</label>
                            <input type="file" class="form-control @error('arquivo') is-invalid @enderror" 
                                   id="arquivo" name="arquivo" required>
                            @error('arquivo')
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
                <a href="{{ route('comprovantes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
</div>
@endsection