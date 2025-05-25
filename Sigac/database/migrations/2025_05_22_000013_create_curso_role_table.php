<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('curso_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curso_id')
                ->constrained('cursos')
                ->onDelete('cascade');
                
            $table->foreignId('role_id')
                ->constrained('roles')
                ->onDelete('cascade');
                
            $table->boolean('pode_gerenciar')->default(false);
            $table->boolean('pode_inscrever')->default(false);
            $table->boolean('pode_avaliar')->default(false);
            
            $table->timestamps();
            
            $table->unique(['curso_id', 'role_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curso_role');
    }
};