<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('slug')->unique();
            $table->text('descricao')->nullable();
            $table->integer('carga_horaria');
            $table->decimal('preco', 10, 2)->nullable();
            $table->integer('duracao_meses')->nullable();
            $table->string('dificuldade')->default('intermediario');
            $table->boolean('certificado')->default(true);
            $table->boolean('ativo')->default(true);
            
            // Chaves estrangeiras
            $table->foreignId('categoria_id')
                ->constrained('categorias')
                ->onDelete('cascade');
                
            $table->foreignId('nivel_id')
                ->constrained('niveis')
                ->onDelete('cascade');
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('slug');
            $table->index('categoria_id');
            $table->index('nivel_id');
            $table->index('ativo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};