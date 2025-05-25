<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Categoria extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'categorias';
    
    protected $fillable = [
        'nome',
        'descricao',
        'slug',
        'icone',
        'cor',
        'ativo'
    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'ativo' => 'boolean'
    ];

    // Mutators
    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Scopes
    public function scopeAtivo($query)
    {
        return $query->where('ativo', true);
    }

    public function scopePorNome($query, $nome)
    {
        return $query->where('nome', 'like', "%$nome%");
    }

    // Relacionamentos
    public function cursos()
    {
        return $this->hasMany(Curso::class)->withDefault();
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class)->withDefault();
    }

    // Métodos
    public function cursosAtivos()
    {
        return $this->cursos()->where('ativo', true);
    }

    public function possuiCursos()
    {
        return $this->cursos()->exists();
    }
}