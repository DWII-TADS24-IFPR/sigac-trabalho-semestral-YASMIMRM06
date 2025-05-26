@extends('layouts.app')

@section('title', 'SIGAC - Home')

@section('content')

<h1>HOME</h1>

<h3>Bem vindo!</h3>

<div class="botoes">
        <div class="card">
            <h4>Alunos</h4>
            <a class="button botao" href="{{ route('alunos.index') }}">Index</a></button>
            <a class="button botao" href="{{ route('alunos.create') }}">Create</a></button>
        </div>
        <div class="card">
            <h4>Categorias</h4>
            <a class="button botao" href="{{ route('categorias.index') }}">Index</a></button>
            <a class="button botao" href="{{ route('categorias.create') }}">Create</a></button>
        </div>
        <div class="card">
            <h4>Comprovantes</h4>
            <a class="button botao" href="{{ route('comprovantes.index') }}">Index</a></button>
            <a class="button botao" href="{{ route('comprovantes.create') }}">Create</a></button>
        </div>
        <div class="card">
            <h4>Cursos</h4>
            <a class="button botao" href="{{ route('cursos.index') }}">Index</a></button>
            <a class="button botao" href="{{ route('cursos.create') }}">Create</a></button>
        </div>
        <div class="card">
            <h4>Declarações</h4>
            <a class="button botao" href="{{ route('declaracoes.index') }}">Index</a></button>
            <a class="button botao" href="{{ route('declaracoes.create') }}">Create</a></button>
        </div>
        <div class="card">
            <h4>Documentos</h4>
            <a class="button botao" href="{{ route('documentos.index') }}">Index</a></button>
            <a class="button botao" href="{{ route('documentos.create') }}">Create</a></button>
        </div>
        <div class="card">
            <h4>Niveis</h4>
            <a class="button botao" href="{{ route('nivels.index') }}">Index</a></button>
            <a class="button botao" href="{{ route('nivels.create') }}">Create</a></button>
        </div>
        <div class="card">
            <h4>Turmas</h4>
            <a class="button botao" href="{{ route('turmas.index') }}">Index</a></button>
            <a class="button botao" href="{{ route('turmas.create') }}">Create</a></button>
        </div>
    </div>

    @endsection