<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Curso;
use App\Models\Aluno;

class Turma extends Model
{
    use SoftDeletes;
    protected $table = "turmas";
    protected $fillable = ['curso_id', 'ano'];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }
}