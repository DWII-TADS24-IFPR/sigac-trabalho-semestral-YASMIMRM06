<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Aluno;
class Declaracao extends Model
{
    use SoftDeletes;

    protected $table = "declaracoes";

    protected $fillable = ['hash', 'data', 'aluno_id'];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

}
