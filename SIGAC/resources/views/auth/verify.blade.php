@extends('layouts.auth')

@section('title', 'Verificar E-mail')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Verificação de E-mail Necessária</h5>
                </div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Um novo link de verificação foi enviado para o seu endereço de e-mail.
                        </div>
                    @endif

                    <p>Antes de continuar, por favor verifique seu e-mail para um link de verificação.</p>
                    <p>Se você não recebeu o e-mail,</p>

                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                            clique aqui para solicitar outro
                        </button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection