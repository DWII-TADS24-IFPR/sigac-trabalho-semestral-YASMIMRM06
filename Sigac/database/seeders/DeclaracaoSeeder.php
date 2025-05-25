<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeclaracoesTable extends Migration
{
    public function up()
    {
        Schema::create('declaracoes', function (Blueprint $table) {
            $table->id();
            $table->string('hash', 64)->unique()->comment('Unique identifier for public access');
            $table->string('titulo');
            $table->text('conteudo');
            $table->dateTime('data_emissao');
            $table->dateTime('data_validade')->nullable();
            $table->enum('status', ['rascunho', 'emitida', 'cancelada'])->default('rascunho');
            $table->string('codigo_validacao')->unique()->nullable();
            $table->boolean('modelo')->default(false);
            
            // Relationships
            $table->foreignId('aluno_id')
                ->constrained('alunos')
                ->onDelete('cascade');
                
            $table->foreignId('comprovante_id')
                ->nullable()
                ->constrained('comprovantes')
                ->onDelete('set null');
                
            $table->foreignId('responsavel_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');
                
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('hash');
            $table->index('aluno_id');
            $table->index('comprovante_id');
            $table->index('status');
            $table->index('modelo');
        });
    }

    public function down()
    {
        Schema::dropIfExists('declaracoes');
    }
}