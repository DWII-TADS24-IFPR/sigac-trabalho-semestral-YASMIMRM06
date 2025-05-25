<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comprovantes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('codigo')->unique();
            $table->text('descricao')->nullable();
            $table->string('arquivo');
            $table->date('data_emissao');
            $table->date('data_validade')->nullable();
            $table->enum('status', ['pendente', 'verificado', 'rejeitado'])->default('pendente');
            $table->text('feedback')->nullable();
            
            $table->foreignId('aluno_id')
                ->constrained('alunos')
                ->onDelete('cascade');
                
            $table->foreignId('documento_id')
                ->constrained('documentos')
                ->onDelete('cascade');
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('codigo');
            $table->index('aluno_id');
            $table->index('documento_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comprovantes');
    }
};