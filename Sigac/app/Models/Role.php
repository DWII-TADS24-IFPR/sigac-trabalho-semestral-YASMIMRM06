<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'roles';
    
    protected $fillable = [
        'nome',
        'descricao',
        'slug',
        'nivel',
        'protegido'
    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'protegido' => 'boolean',
        'nivel' => 'integer'
    ];

    // Scopes
    public function scopeAdministrativas($query)
    {
        return $query->where('nivel', '>', 5);
    }

    public function scopeBasicas($query)
    {
        return $query->where('nivel', '<=', 5);
    }

    // Relacionamentos
    public function alunos()
    {
        return $this->belongsToMany(Aluno::class)->withTimestamps();
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class)->withTimestamps();
    }

    public function comprovantes()
    {
        return $this->belongsToMany(Comprovante::class)->withTimestamps();
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class)->withTimestamps();
    }

    public function declaracoes()
    {
        return $this->belongsToMany(Declaracao::class)->withTimestamps();
    }

    public function documentos()
    {
        return $this->belongsToMany(Documento::class)->withTimestamps();
    }

    public function niveis()
    {
        return $this->belongsToMany(Nivel::class)->withTimestamps();
    }

    public function turmas()
    {
        return $this->belongsToMany(Turma::class)->withTimestamps();
    }

    // Métodos
    public function podeSerExcluida()
    {
        return !$this->protegido;
    }

    public function usuariosComEstaRole()
    {
        return $this->alunos()->count();
    }
}