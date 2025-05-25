<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('turma_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('turma_id')
                ->constrained('turmas')
                ->onDelete('cascade');
                
            $table->foreignId('role_id')
                ->constrained('roles')
                ->onDelete('cascade');
            
            $table->json('permissoes')->nullable()->comment('Permissões específicas em formato JSON');
            $table->boolean('pode_matricular')->default(false);
            $table->boolean('pode_gerenciar_aulas')->default(false);
            $table->boolean('pode_emitir_declaracoes')->default(false);
            
            $table->timestamps();
            
            $table->unique(['turma_id', 'role_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('turma_role');
    }
};