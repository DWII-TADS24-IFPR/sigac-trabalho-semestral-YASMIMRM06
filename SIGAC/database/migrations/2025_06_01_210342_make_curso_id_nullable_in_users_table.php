<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Adiciona valor padrão para role_id (2 = aluno)
            $table->unsignedBigInteger('role_id')
                  ->default(2)
                  ->change();
                  
            // Torna curso_id nullable
            $table->unsignedBigInteger('curso_id')
                  ->nullable()
                  ->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverte as alterações
            $table->unsignedBigInteger('role_id')
                  ->default(null)
                  ->change();
                  
            $table->unsignedBigInteger('curso_id')
                  ->nullable(false)
                  ->change();
        });
    }
};