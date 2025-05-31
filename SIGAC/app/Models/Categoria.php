<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\{Comprovante, Documento};

class Categoria extends Model
{
    use SoftDeletes;

    protected $table = "categorias";

    protected $fillable = ['nome', 'maximo_horas', 'curso_id'];

    public function comprovantes()
    {
        return $this->hasMany(Comprovante::class);
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
    public function curso()
    {
        return $this->belongsTo(Curso::class); 
    }

}
