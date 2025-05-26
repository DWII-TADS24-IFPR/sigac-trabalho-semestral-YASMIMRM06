<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlunoController;
// use App\Http\Controllers\CategoriaController;
// use App\Http\Controllers\ComprovanteController;
use App\Http\Controllers\CursoController;
// use App\Http\Controllers\DeclaracaoController;
use App\Http\Controllers\DocumentoController;
// use App\Http\Controllers\NivelController;
use App\Http\Controllers\TurmaController;

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');


// // Rotas para Alunos
Route::resource('/alunos', AlunoController::class);

// Route::get('alunos/restore/{id}', [AlunoController::class, 'restore'])->name('alunos.restore');

// // Rotas para Categorias
// Route::resource('categorias', CategoriaController::class);
// Route::get('categorias/restore/{id}', [CategoriaController::class, 'restore'])->name('categorias.restore');

// // Rotas para Comprovantes
// Route::resource('comprovantes', ComprovanteController::class);
// Route::get('comprovantes/restore/{id}', [ComprovanteController::class, 'restore'])->name('comprovantes.restore');

// // Rotas para Cursos
Route::resource('cursos', CursoController::class);
Route::get('cursos/restore/{id}', [CursoController::class, 'restore'])->name('cursos.restore');

// // Rotas para Declarações
// Route::resource('declaracoes', DeclaracaoController::class);
// Route::get('declaracoes/restore/{id}', [DeclaracaoController::class, 'restore'])->name('declaracoes.restore');

// // Rotas para Documentos
Route::resource('documentos', DocumentoController::class);
Route::get('documentos/restore/{id}', [DocumentoController::class, 'restore'])->name('documentos.restore');

// // Rotas para Níveis
// Route::resource('niveis', NivelController::class);
// Route::get('niveis/restore/{id}', [NivelController::class, 'restore'])->name('niveis.restore');

// // Rotas para Turmas
Route::resource('turmas', TurmaController::class);
Route::get('turmas/restore/{id}', [TurmaController::class, 'restore'])->name('turmas.restore');