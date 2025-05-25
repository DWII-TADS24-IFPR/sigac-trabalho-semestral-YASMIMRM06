<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comprovante_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comprovante_id')
                ->constrained('comprovantes')
                ->onDelete('cascade');
                
            $table->foreignId('role_id')
                ->constrained('roles')
                ->onDelete('cascade');
                
            $table->enum('nivel_acesso', ['leitura', 'escrita', 'controle_total'])
                ->default('leitura');
                
            $table->timestamps();
            
            $table->unique(['comprovante_id', 'role_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comprovante_role');
    }
};