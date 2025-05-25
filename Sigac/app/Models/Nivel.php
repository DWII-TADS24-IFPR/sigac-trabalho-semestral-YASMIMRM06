<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nivel extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'niveis';
    
    protected $fillable = [
        'nome',
        'descricao',
        'ordem',
        'icone',
        'cor',
        'ativo'
    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'ativo' => 'boolean',
        'ordem' => 'integer'
    ];

    // Scopes
    public function scopeAtivo($query)
    {
        return $query->where('ativo', true);
    }

    public function scopeOrdenado($query)
    {
        return $query->orderBy('ordem');
    }

    // Relacionamentos
    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }

    // Métodos
    public function cursosAtivos()
    {
        return $this->cursos()->where('ativo', true);
    }

    public function atualizarOrdem($novaOrdem)
    {
        $this->ordem = $novaOrdem;
        $this->save();
    }

    public function podeSerExcluido()
    {
        return !$this->cursos()->exists();
    }
}