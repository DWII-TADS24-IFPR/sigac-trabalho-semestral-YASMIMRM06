<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->string('slug')->unique();
            $table->text('descricao')->nullable();
            $table->integer('nivel')->default(1);
            $table->boolean('protegido')->default(false);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('slug');
            $table->index('nivel');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};