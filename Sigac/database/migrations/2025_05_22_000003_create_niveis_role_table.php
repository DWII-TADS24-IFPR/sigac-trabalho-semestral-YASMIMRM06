<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('niveis', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('slug')->unique();
            $table->text('descricao')->nullable();
            $table->integer('ordem')->unique();
            $table->string('icone')->nullable();
            $table->string('cor', 7)->default('#6c757d');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('slug');
            $table->index('ordem');
            $table->index('ativo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('niveis');
    }
};