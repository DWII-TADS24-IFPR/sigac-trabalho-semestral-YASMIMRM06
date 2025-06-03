@extends('layouts.app')

@section('title', 'Cadastro')

@section('content')
<section class="sigac-hero">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="sigac-card">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold mb-3">Cadastro de Usuário</h2>
                            <p class="text-muted">Preencha os dados para criar sua conta</p>
                        </div>
                        
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome Completo</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                       placeholder="Digite seu nome completo">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail Institucional</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" required autocomplete="email"
                                       placeholder="seu.email@xyz.edu.br">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="user_type" class="form-label">Tipo de Usuário</label>
                                <select id="user_type" class="form-select @error('user_type') is-invalid @enderror" 
                                        name="user_type" required>
                                    <option value="" disabled selected>Selecione seu perfil...</option>
                                    <option value="student" {{ old('user_type') == 'student' ? 'selected' : '' }}>Aluno</option>
                                    <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Administrador</option>
                                </select>
                                @error('user_type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="new-password"
                                       placeholder="••••••••">
                                <small class="text-muted">Mínimo de 8 caracteres</small>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="password-confirm" class="form-label">Confirmar Senha</label>
                                <input id="password-confirm" type="password" class="form-control" 
                                       name="password_confirmation" required autocomplete="new-password"
                                       placeholder="••••••••">
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-sigac btn-lg py-2">Registrar</button>
                                <a href="{{ route('login') }}" class="btn btn-outline-secondary">Já tenho uma conta</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection