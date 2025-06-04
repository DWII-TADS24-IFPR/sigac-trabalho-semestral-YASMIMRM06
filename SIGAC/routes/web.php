<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\Admin\ActivityController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Student\StudentActivityController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rotas principais do sistema SIGAC - Gerenciamento de Atividades Complementares
| Implementação completa conforme documentação e requisitos funcionais
|
*/

// ==================== ROTAS PÚBLICAS ====================
Route::get('/', function () {
    return view('welcome', ['title' => 'Bem-vindo ao SIGAC']);
})->name('welcome');

Route::get('/about', [AboutController::class, 'index'])->name('about');

// ==================== AUTENTICAÇÃO ====================
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    // Registro (apenas para alunos)
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    
    // Recuperação de senha
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ==================== VERIFICAÇÃO DE EMAIL ====================
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [VerificationController::class, 'notice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->middleware('signed')->name('verification.verify');
    Route::post('/email/resend', [VerificationController::class, 'resend'])
        ->middleware('throttle:6,1')->name('verification.resend');
});

// ==================== ÁREA LOGADA ====================
Route::middleware(['auth', 'verified'])->group(function () {
    // Página inicial após login
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Rota genérica para atividades (redireciona conforme tipo de usuário)
    Route::get('/activities', function () {
        return auth()->user()->isAdmin() 
            ? redirect()->route('admin.activities.index')
            : redirect()->route('student.activities.index');
    })->name('atividades.index');
    
    // ========== ROTAS DO ALUNO ==========
    Route::prefix('student')->middleware('can:isStudent')->group(function () {
        // Perfil do aluno
        Route::get('/profile', [ProfileController::class, 'show'])->name('student.profile');
        Route::put('/profile', [ProfileController::class, 'update'])->name('student.profile.update');
        
        // Atividades Complementares (RF03)
        Route::prefix('activities')->group(function () {
            // Listagem de atividades
            Route::get('/', [StudentActivityController::class, 'index'])->name('student.activities.index');
            
            // Criação de nova atividade
            Route::get('/create', [StudentActivityController::class, 'create'])->name('student.activities.create');
            Route::post('/', [StudentActivityController::class, 'store'])->name('student.activities.store');
            
            // Exportação de dados (RF04)
            Route::get('/export', [StudentActivityController::class, 'export'])->name('student.activities.export');
            
            // Declaração de conclusão (RF04)
            Route::get('/certificate', [StudentActivityController::class, 'certificate'])->name('student.certificate');
            
            // Operações em atividades específicas
            Route::prefix('{activity}')->group(function () {
                Route::get('/', [StudentActivityController::class, 'show'])->name('student.activities.show');
                Route::get('/edit', [StudentActivityController::class, 'edit'])->name('student.activities.edit');
                Route::put('/', [StudentActivityController::class, 'update'])->name('student.activities.update');
                Route::delete('/', [StudentActivityController::class, 'destroy'])->name('student.activities.destroy');
            });
        });
    });
    
    // ========== ROTAS DO ADMINISTRADOR ==========
    Route::prefix('admin')->middleware('can:isAdmin')->group(function () {
        // Dashboard administrativo
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        
        // Gerenciamento de atividades (RF07)
        Route::prefix('activities')->group(function () {
            // Listagem de todas as atividades
            Route::get('/', [ActivityController::class, 'index'])->name('admin.activities.index');
            
            // Exportação de dados
            Route::get('/export', [ActivityController::class, 'export'])->name('admin.activities.export');
            
            // Operações em atividades específicas
            Route::prefix('{activity}')->group(function () {
                // Revisão e avaliação de atividades
                Route::get('/review', [ActivityController::class, 'review'])->name('admin.activities.review');
                Route::put('/', [ActivityController::class, 'update'])->name('admin.activities.update');
            });
        });
        
        // Gerenciamento de alunos (RF06)
        Route::resource('students', StudentController::class)->names([
            'index' => 'admin.students.index',
            'create' => 'admin.students.create',
            'store' => 'admin.students.store',
            'show' => 'admin.students.show',
            'edit' => 'admin.students.edit',
            'update' => 'admin.students.update',
            'destroy' => 'admin.students.destroy'
        ]);
        
        // Gerenciamento de categorias (RF06)
        Route::resource('categories', CategoryController::class)->except(['show'])->names([
            'index' => 'admin.categories.index',
            'create' => 'admin.categories.create',
            'store' => 'admin.categories.store',
            'edit' => 'admin.categories.edit',
            'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy'
        ]);
        
        // Relatórios (RF08)
        Route::prefix('reports')->group(function () {
            // Relatório geral
            Route::get('/', [ReportController::class, 'index'])->name('admin.reports');
            
            // Horas por aluno
            Route::get('/students-hours', [ReportController::class, 'studentsHours'])->name('admin.reports.students-hours');
            
            // Atividades por categoria
            Route::get('/activities-by-category', [ReportController::class, 'activitiesByCategory'])->name('admin.reports.activities-by-category');
            
            // Relatório por turma
            Route::get('/by-class', [ReportController::class, 'byClass'])->name('admin.reports.by-class');
        });
    });
});

// ==================== ROTAS DE API ====================
Route::prefix('api')->middleware('auth:sanctum')->group(function () {
    // API para gráficos do dashboard
    Route::get('/dashboard-stats', [DashboardController::class, 'getStats']);
    
    // API para relatórios
    Route::get('/reports/activities-data', [ReportController::class, 'getActivitiesData']);
});

// ==================== FALLBACK ROUTE ====================
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});