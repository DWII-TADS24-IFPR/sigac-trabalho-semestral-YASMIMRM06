<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 150);
            $table->string('cpf', 11)->unique();
            $table->string('email')->unique();
            $table->string('senha');
            $table->string('telefone', 20)->nullable();
            $table->date('data_nascimento')->nullable();
            $table->text('endereco')->nullable();
            $table->boolean('ativo')->default(true);
            
            $table->foreignId('curso_id')
                ->constrained('cursos')
                ->onDelete('cascade');
                
            $table->foreignId('turma_id')
                ->nullable()
                ->constrained('turmas')
                ->onDelete('set null');
            
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');
            
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('cpf');
            $table->index('email');
            $table->index('curso_id');
            $table->index('turma_id');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};