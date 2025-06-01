@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2>{{ $title }}</h2>
        </div>
        <div class="card-body">
            <p class="lead">{{ $description }}</p>
            <hr>
            
            <h4>Funcionalidades:</h4>
            <ul>
                @foreach($features as $feature)
                    <li>{{ $feature }}</li>
                @endforeach
            </ul>
            
            <div class="mt-4">
                <h4>Informações Técnicas:</h4>
                <p><strong>Versão:</strong> {{ $version }}</p>
                <p><strong>Desenvolvido por:</strong> Equipe TADS24</p>
                <p><strong>Tecnologias:</strong> Laravel, Bootstrap, MySQL</p>
            </div>
        </div>
    </div>
</div>
@endsection