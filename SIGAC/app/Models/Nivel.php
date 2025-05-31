<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Curso;

class Nivel extends Model
{
    use SoftDeletes;
    protected $table = "niveis";
    protected $fillable = ['nome'];

    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }
}
