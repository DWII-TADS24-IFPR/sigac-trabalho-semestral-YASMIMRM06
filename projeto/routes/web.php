<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComprovanteController;
use App\Http\Controllers\DeclaracaoController;
use App\Http\Controllers\DocumentoController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('/Aluno', AlunoController::class);
Route::resource('/Categoria', CategoriaController::class);
Route::resource('/Comprovante', ComprovanteController::class);
Route::resource('/Declaracao', DeclaracaoController::class);
Route::resource('/Documento', DocumentoController::class);
Route::resource('/Curso', CursoController::class);
Route::resource('/Nivel', NivelController::class);
Route::resource('/uTrma', TurmaController::class);