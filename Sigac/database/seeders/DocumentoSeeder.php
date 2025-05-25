<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('url');
            $table->string('nome_arquivo');
            $table->string('mime_type');
            $table->integer('tamanho')->comment('Size in bytes');
            $table->text('descricao')->nullable();
            $table->float('horas_solicitadas');
            $table->float('horas_validadas')->nullable();
            $table->enum('status', ['pendente', 'aprovado', 'reprovado', 'em_analise'])->default('pendente');
            $table->text('feedback')->nullable();
            $table->date('data_atividade');
            $table->date('data_envio')->useCurrent();
            
            // Relationships
            $table->foreignId('categoria_id')
                ->constrained('categorias')
                ->onDelete('cascade');
                
            $table->foreignId('aluno_id')
                ->constrained('alunos')
                ->onDelete('cascade');
                
            $table->foreignId('avaliador_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');
                
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('categoria_id');
            $table->index('aluno_id');
            $table->index('avaliador_id');
            $table->index('status');
            $table->index('data_atividade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentos');
    }
}