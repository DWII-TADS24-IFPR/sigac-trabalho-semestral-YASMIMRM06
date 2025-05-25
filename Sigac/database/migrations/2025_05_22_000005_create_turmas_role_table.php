<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('codigo')->unique();
            $table->text('descricao')->nullable();
            $table->date('data_inicio');
            $table->date('data_fim')->nullable();
            $table->string('sala')->nullable();
            $table->string('horario')->nullable();
            $table->integer('vagas')->default(30);
            $table->integer('vagas_ocupadas')->default(0);
            $table->enum('status', ['planejada', 'ativa', 'concluida', 'cancelada'])->default('planejada');
            
            $table->foreignId('curso_id')
                ->constrained('cursos')
                ->onDelete('cascade');
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('codigo');
            $table->index('status');
            $table->index('curso_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('turmas');
    }
};