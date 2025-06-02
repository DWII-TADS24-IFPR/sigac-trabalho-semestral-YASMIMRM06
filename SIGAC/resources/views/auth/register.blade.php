@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ __('Cadastro de Usuário') }}</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nome Completo -->
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Nome Completo') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('E-mail Institucional') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required 
                                   placeholder="exemplo@institucional.edu.br">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Tipo de Usuário -->
                        <div class="mb-3">
                            <label for="role_id" class="form-label">{{ __('Tipo de Usuário') }}</label>
                            <select id="role_id" class="form-select @error('role_id') is-invalid @enderror" 
                                    name="role_id" required>
                                <option value="" disabled selected>Selecione seu perfil</option>
                                @foreach($roles as $id => $name)
                                    <option value="{{ $id }}" {{ old('role_id') == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Curso (mostrado apenas para alunos) -->
                        <div class="mb-3" id="curso-field" style="{{ old('role_id') == 2 ? '' : 'display: none;' }}">
                            <label for="curso_id" class="form-label">{{ __('Curso') }}</label>
                            <select id="curso_id" class="form-select @error('curso_id') is-invalid @enderror" 
                                    name="curso_id" {{ old('role_id') == 2 ? 'required' : '' }}>
                                <option value="" disabled selected>Selecione seu curso</option>
                                @foreach($cursos as $curso)
                                    <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                                        {{ $curso->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('curso_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Senha -->
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Senha') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted">
                                Mínimo de 8 caracteres
                            </small>
                        </div>

                        <!-- Confirmar Senha -->
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label">{{ __('Confirmar Senha') }}</label>
                            <input id="password-confirm" type="password" class="form-control" 
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <!-- Botão de Registro -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Registrar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>