<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nivel_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nivel_id')
                ->constrained('niveis')
                ->onDelete('cascade');
                
            $table->foreignId('role_id')
                ->constrained('roles')
                ->onDelete('cascade');
            
            $table->boolean('pode_gerenciar_cursos')->default(false);
            $table->boolean('pode_definir_preco')->default(false);
            $table->boolean('pode_alterar_ordem')->default(false);
            
            $table->timestamps();
            
            $table->unique(['nivel_id', 'role_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nivel_role');
    }
};