<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('declaracao_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('declaracao_id')
                ->constrained('declaracoes')
                ->onDelete('cascade');
                
            $table->foreignId('role_id')
                ->constrained('roles')
                ->onDelete('cascade');
            
            $table->boolean('pode_emitir')->default(false);
            $table->boolean('pode_visualizar')->default(true);
            $table->boolean('pode_cancelar')->default(false);
            $table->boolean('pode_gerar_modelo')->default(false);
            
            $table->timestamps();
            
            $table->unique(['declaracao_id', 'role_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('declaracao_role');
    }
};