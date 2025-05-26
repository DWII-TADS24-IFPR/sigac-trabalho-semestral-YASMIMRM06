<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComprovanteController;
use App\Http\Controllers\DeclaracaoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\TurmaController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('alunos', AlunoController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('comprovantes', ComprovanteController::class);
Route::resource('declaracoes', DeclaracaoController::class);
Route::resource('documentos', DocumentoController::class);
Route::resource('cursos', CursoController::class);
Route::resource('nivels', NivelController::class);   // ou niveis, dependendo do plural correto
Route::resource('turmas', TurmaController::class);
