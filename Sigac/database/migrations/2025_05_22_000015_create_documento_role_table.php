<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documento_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('documento_id')
                ->constrained('documentos')
                ->onDelete('cascade');
                
            $table->foreignId('role_id')
                ->constrained('roles')
                ->onDelete('cascade');
            
            $table->enum('nivel_acesso', [
                'nenhum', 
                'visualizacao', 
                'upload', 
                'validacao', 
                'gerenciamento'
            ])->default('visualizacao');
            
            $table->timestamps();
            
            $table->unique(['documento_id', 'role_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documento_role');
    }
};