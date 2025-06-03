@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bem-vindo ao SIGAC</div>

                <div class="card-body">
                    @auth
                        <div class="alert alert-success" role="alert">
                            Olá, {{ auth()->user()->name }}! Você está logado como 
                            {{ auth()->user()->isAdmin() ? 'Administrador' : 'Aluno' }}.
                        </div>
                        
                        <div class="d-grid gap-2">
                            <a href="{{ route('atividades.index') }}" class="btn btn-primary">
                                Ver Atividades
                            </a>
                        </div>
                    @else
                        <p>Sistema de Gestão de Atividades Complementares</p>
                        
                        <div class="d-grid gap-2">
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                Entrar no Sistema
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-secondary">
                                Criar Nova Conta
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection