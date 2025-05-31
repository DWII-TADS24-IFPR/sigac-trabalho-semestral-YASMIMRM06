<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;

class Eixo extends Model
{
    protected $table = "eixos";
    protected $fillable = ['nome'];

    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }

}
