<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Turma extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'turmas';
    
    protected $fillable = [
        'nome',
        'descricao',
        'data_inicio',
        'data_fim',
        'curso_id',
        'sala',
        'horario',
        'status',
        'vagas',
        'vagas_ocupadas'
    ];

    protected $dates = [
        'deleted_at',
        'data_inicio',
        'data_fim'
    ];

    protected $casts = [
        'vagas' => 'integer',
        'vagas_ocupadas' => 'integer'
    ];

    // Scopes
    public function scopeAtivas($query)
    {
        return $query->where('status', 'ativa');
    }

    public function scopePorCurso($query, $cursoId)
    {
        return $query->where('curso_id', $cursoId);
    }

    public function scopeComVagas($query)
    {
        return $query->whereRaw('vagas > vagas_ocupadas');
    }

    // Relacionamentos
    public function curso()
    {
        return $this->belongsTo(Curso::class)->withDefault();
    }

    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }

    // Métodos
    public function atualizarStatus()
    {
        $agora = now();
        
        if ($this->data_fim && $this->data_fim->lt($agora)) {
            $this->status = 'concluida';
        } elseif ($this->data_inicio->gt($agora)) {
            $this->status = 'planejada';
        } else {
            $this->status = 'ativa';
        }
        
        $this->save();
    }

    public function vagasDisponiveis()
    {
        return $this->vagas - $this->vagas_ocupadas;
    }

    public function matricularAluno()
    {
        if ($this->vagasDisponiveis() > 0) {
            $this->vagas_ocupadas++;
            $this->save();
            return true;
        }
        return false;
    }

    public function desmatricularAluno()
    {
        if ($this->vagas_ocupadas > 0) {
            $this->vagas_ocupadas--;
            $this->save();
        }
    }
}