<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\{Nivel, Eixo, Turma, Aluno, Categoria, User};

class Curso extends Model
{
    use SoftDeletes;

    protected $table = "cursos";

    protected $fillable = ['nome', 'sigla', 'total_horas', 'nivel_id', 'eixo_id'];

    public function nivel()
    {
        return $this->belongsTo(Nivel::class);
    }

    public function eixo()
    {
        return $this->belongsTo(Eixo::class);
    }

    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }

    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }

    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
