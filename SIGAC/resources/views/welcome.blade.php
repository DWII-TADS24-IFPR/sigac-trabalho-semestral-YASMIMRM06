@extends('layouts.app')

@section('title', 'Bem-vindo ao SIGAC')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 75vh;">
        <div class="col-md-8 text-center">
            <div class="card shadow-lg border-0 rounded-4 p-5 bg-light">
                <h1 class="display-4 text-primary fw-bold mb-3">Bem-vindo ao <span class="text-dark">SIGAC</span></h1>
                <p class="lead text-muted mb-4">
                    Sistema de Gerenciamento Acadêmico Completo para Alunos e Administradores.
                </p>
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 shadow-sm">
                        Entrar
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg px-5 shadow-sm">
                        Cadastre-se
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
