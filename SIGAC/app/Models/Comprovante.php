<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\{Aluno, Categoria, User};

class Comprovante extends Model
{
    use SoftDeletes;

    protected $table = "comprovantes";

    protected $fillable = ['horas', 'atividade', 'categoria_id', 'aluno_id', 'user_id'];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
