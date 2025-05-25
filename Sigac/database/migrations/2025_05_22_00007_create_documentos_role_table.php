<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->text('descricao')->nullable();
            $table->string('arquivo');
            $table->date('data_emissao');
            $table->date('validade')->nullable();
            $table->string('tipo')->default('documento');
            $table->enum('status', ['pendente', 'aprovado', 'rejeitado'])->default('pendente');
            $table->text('observacoes')->nullable();
            
            $table->foreignId('aluno_id')
                ->constrained('alunos')
                ->onDelete('cascade');
                
            $table->foreignId('categoria_id')
                ->constrained('categorias')
                ->onDelete('cascade');
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('slug');
            $table->index('aluno_id');
            $table->index('categoria_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};