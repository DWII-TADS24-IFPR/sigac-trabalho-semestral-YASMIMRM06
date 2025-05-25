<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Declaracao extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'declaracoes';
    
    protected $fillable = [
        'titulo',
        'descricao',
        'conteudo',
        'data_emissao',
        'aluno_id',
        'modelo',
        'assinatura',
        'codigo_validacao'
    ];

    protected $dates = ['deleted_at', 'data_emissao'];

    protected $casts = [
        'modelo' => 'boolean'
    ];

    // Scopes
    public function scopePorAluno($query, $alunoId)
    {
        return $query->where('aluno_id', $alunoId);
    }

    public function scopeModelos($query)
    {
        return $query->where('modelo', true);
    }

    public function scopeEmitidas($query)
    {
        return $query->where('modelo', false);
    }

    // Relacionamentos
    public function aluno()
    {
        return $this->belongsTo(Aluno::class)->withDefault();
    }

    // Métodos
    public function gerarCodigoValidacao()
    {
        $this->codigo_validacao = Str::random(32);
        $this->save();
    }

    public function marcarComoModelo()
    {
        $this->update(['modelo' => true]);
    }

    public function gerarPDF()
    {
        $pdf = PDF::loadView('declaracoes.modelo', ['declaracao' => $this]);
        return $pdf->stream("declaracao-{$this->id}.pdf");
    }

    public function getAssinaturaUrlAttribute()
    {
        return $this->assinatura ? Storage::url($this->assinatura) : null;
    }
}