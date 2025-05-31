<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\EixoController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\GraficoController;

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\DeclaracaoController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\SolicitacaoController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Middleware\CheckRole;

Route::get('/', function () {
    return view('welcome');
});

//Rotas para autenticação de middleware 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', CheckRole::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('alunos', AlunoController::class);
    Route::resource('cursos', CursoController::class);
    Route::resource('turmas', TurmaController::class);
    Route::resource('eixos', EixoController::class);
    Route::resource('niveis', NivelController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('avaliacoes', AvaliacaoController::class);
    Route::post('avaliacoes/{id}/aprovar', [AvaliacaoController::class, 'aprovar'])->name('avaliacoes.aprovar');
    Route::post('avaliacoes/{id}/rejeitar', [AvaliacaoController::class, 'rejeitar'])->name('avaliacoes.rejeitar');
    Route::resource('graficos', GraficoController::class);


});

Route::middleware(['auth', CheckRole::class . ':aluno'])->prefix('aluno')->name('aluno.')->group(function (){
    Route::get('/dashboard', [AlunoController::class, 'dashboard'])->name('dashboard');
    Route::resource('perfil', PerfilController::class);
    Route::resource('solicitacoes', SolicitacaoController::class);
    Route::resource('declaracoes', DeclaracaoController::class);
});
     
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//rota para o redirecionamento para a tela de login ao dar logout
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

require __DIR__ . '/auth.php';