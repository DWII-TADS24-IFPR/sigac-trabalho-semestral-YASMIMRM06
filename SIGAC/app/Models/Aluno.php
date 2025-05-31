<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\{Curso, Turma, User, Comprovante, Declaracao};

class Aluno extends Model
{
    use SoftDeletes;

    protected $table = "alunos";

    protected $fillable = [
        'nome',
        'cpf',
        'email',
        'senha',
        'user_id',
        'curso_id',
        'turma_id',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comprovantes()
    {
        return $this->hasMany(Comprovante::class);
    }

    public function declaracoes()
    {
        return $this->hasMany(Declaracao::class);
    }
}
