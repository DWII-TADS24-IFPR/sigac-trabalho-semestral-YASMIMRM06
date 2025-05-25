<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('declaracoes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('codigo')->unique();
            $table->text('descricao')->nullable();
            $table->longText('conteudo');
            $table->date('data_emissao');
            $table->string('assinatura_digital')->nullable();
            $table->string('codigo_validacao')->unique()->nullable();
            $table->boolean('modelo')->default(false);
            $table->enum('status', ['rascunho', 'emitida', 'cancelada'])->default('rascunho');
            
            $table->foreignId('aluno_id')
                ->constrained('alunos')
                ->onDelete('cascade');
                
            $table->foreignId('responsavel_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('codigo');
            $table->index('codigo_validacao');
            $table->index('aluno_id');
            $table->index('modelo');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('declaracoes');
    }
};