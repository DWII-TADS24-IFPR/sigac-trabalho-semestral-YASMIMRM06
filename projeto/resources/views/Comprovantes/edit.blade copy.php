@extends('template')

@section('title', 'Editar Comprovante')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Editar Comprovante</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('comprovantes.update', $comprovante->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <input type="text" class="form-control @error('tipo') is-invalid @enderror" id="tipo" name="tipo" value="{{ old('tipo', $comprovante->tipo) }}">
                        @error('tipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="documento_id" class="form-label">Documento</label>
                        <select class="form-select @error('documento_id') is-invalid @enderror" id="documento_id" name="documento_id">
                            <option value="">Selecione um documento</option>
                            @foreach($documentos as $documento)
                                <option value="{{ $documento->id }}" @selected(old('documento_id', $comprovante->documento_id) == $documento->id)>
                                    {{ $documento->tipo }} - {{ $documento->aluno->nome ?? 'N/A' }}
                                </option>
                            @endforeach
                        </select>
                        @error('documento_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="data" class="form-label">Data</label>
                        <input type="date" class="form-control @error('data') is-invalid @enderror" id="data" name="data" value="{{ old('data', $comprovante->data->format('Y-m-d')) }}">
                        @error('data')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="valor" class="form-label">Valor</label>
                        <input type="number" step="0.01" class="form-control @error('valor') is-invalid @enderror" id="valor" name="valor" value="{{ old('valor', $comprovante->valor) }}">
                        @error('valor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" rows="3">{{ old('descricao', $comprovante->descricao) }}</textarea>
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="{{ route('comprovantes.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection