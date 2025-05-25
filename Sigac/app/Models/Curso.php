<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curso extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'cursos';
    
    protected $fillable = [
        'nome',
        'descricao',
        'carga_horaria',
        'categoria_id',
        'nivel_id',
        'ativo',
        'dificuldade',
        'preco',
        'duracao_meses'
    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'ativo' => 'boolean',
        'preco' => 'decimal:2'
    ];

    // Scopes
    public function scopeAtivo($query)
    {
        return $query->where('ativo', true);
    }

    public function scopePorCategoria($query, $categoriaId)
    {
        return $query->where('categoria_id', $categoriaId);
    }

    public function scopePorNivel($query, $nivelId)
    {
        return $query->where('nivel_id', $nivelId);
    }

    // Relacionamentos
    public function categoria()
    {
        return $this->belongsTo(Categoria::class)->withDefault();
    }

    public function nivel()
    {
        return $this->belongsTo(Nivel::class)->withDefault();
    }

    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }

    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }

    // Métodos
    public function alunosAtivos()
    {
        return $this->alunos()->where('ativo', true);
    }

    public function turmasAtivas()
    {
        return $this->turmas()->where('status', 'ativa');
    }

    public function atualizarStatus()
    {
        $turmasAtivas = $this->turmas()->where('status', 'ativa')->exists();
        $this->ativo = $turmasAtivas;
        $this->save();
    }
}