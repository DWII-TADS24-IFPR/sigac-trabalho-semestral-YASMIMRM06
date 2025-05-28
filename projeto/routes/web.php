<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComprovanteController;
use App\Http\Controllers\DeclaracaoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\TurmaController;

// Home Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);

// Authentication Middleware Group
Route::middleware(['auth'])->group(function () {
    // Resource Routes with Soft Delete Restoration
    Route::prefix('admin')->group(function () {
        // Alunos Routes
        Route::resource('alunos', AlunoController::class);
        Route::get('alunos/restore/{id}', [AlunoController::class, 'restore'])
            ->name('alunos.restore');

        // Categorias Routes
        Route::resource('categorias', CategoriaController::class);
        Route::get('categorias/restore/{id}', [CategoriaController::class, 'restore'])
            ->name('categorias.restore');

        // Comprovantes Routes
        Route::resource('comprovantes', ComprovanteController::class);
        Route::get('comprovantes/restore/{id}', [ComprovanteController::class, 'restore'])
            ->name('comprovantes.restore');

        // Cursos Routes
        Route::resource('cursos', CursoController::class);
        Route::get('cursos/restore/{id}', [CursoController::class, 'restore'])
            ->name('cursos.restore');

        // Declarações Routes
        Route::resource('declaracoes', DeclaracaoController::class);
        Route::get('declaracoes/restore/{id}', [DeclaracaoController::class, 'restore'])
            ->name('declaracoes.restore');

        // Documentos Routes
        Route::resource('documentos', DocumentoController::class);
        Route::get('documentos/restore/{id}', [DocumentoController::class, 'restore'])
            ->name('documentos.restore');

        // Níveis Routes
        Route::resource('niveis', NivelController::class);
        Route::get('niveis/restore/{id}', [NivelController::class, 'restore'])
            ->name('niveis.restore');

        // Turmas Routes
        Route::resource('turmas', TurmaController::class);
        Route::get('turmas/restore/{id}', [TurmaController::class, 'restore'])
            ->name('turmas.restore');
    });
});

// API Routes
Route::prefix('api')->group(function () {
    Route::apiResource('alunos', AlunoController::class);
    Route::apiResource('categorias', CategoriaController::class);
    Route::apiResource('comprovantes', ComprovanteController::class);
    Route::apiResource('declaracoes', DeclaracaoController::class);
    Route::apiResource('documentos', DocumentoController::class);
    Route::apiResource('cursos', CursoController::class);
    Route::apiResource('niveis', NivelController::class);
    Route::apiResource('turmas', TurmaController::class);
});