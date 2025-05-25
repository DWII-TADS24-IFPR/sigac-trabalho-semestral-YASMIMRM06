<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Curso;
use App\Models\Turma;
use App\Models\User;
use App\Models\Documento;
use App\Models\Comprovante;
use App\Models\Declaracao;

class Aluno extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'alunos';
    
    protected $fillable = [
        'nome',
        'cpf',
        'email',
        'senha',
        'curso_id',
        'turma_id',
        'user_id',
        'data_nascimento',
        'telefone',
        'endereco',
        'ativo'
    ];

    protected $hidden = [
        'senha',
        'remember_token',
    ];

    protected $dates = [
        'deleted_at',
        'data_nascimento',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'ativo' => 'boolean',
        'data_nascimento' => 'date',
    ];

    // Mutators
    public function setSenhaAttribute($value)
    {
        $this->attributes['senha'] = Hash::make($value);
    }

    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = preg_replace('/[^0-9]/', '', $value);
    }

    // Accessors
    public function getCpfFormatadoAttribute()
    {
        return substr($this->cpf, 0, 3) . '.' . 
               substr($this->cpf, 3, 3) . '.' . 
               substr($this->cpf, 6, 3) . '-' . 
               substr($this->cpf, 9, 2);
    }

    // Scopes
    public function scopeAtivo($query)
    {
        return $query->where('ativo', true);
    }

    public function scopePorCurso($query, $cursoId)
    {
        return $query->where('curso_id', $cursoId);
    }

    public function scopePorTurma($query, $turmaId)
    {
        return $query->where('turma_id', $turmaId);
    }

    // Relacionamentos
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class)->withDefault([
            'nome' => 'Curso não definido'
        ]);
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class)->withDefault([
            'nome' => 'Turma não definida'
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    public function comprovantes()
    {
        return $this->hasMany(Comprovante::class);
    }

    public function declaracoes()
    {
        return $this->hasMany(Declaracao::class);
    }

    // Métodos
    public function possuiRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('nome', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }

    public function atribuirRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('nome', $role)->firstOrFail();
        }

        $this->roles()->syncWithoutDetaching($role);
    }
}