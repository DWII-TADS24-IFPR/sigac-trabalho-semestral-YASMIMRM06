<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Comprovante extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'comprovantes';
    
    protected $fillable = [
        'titulo',
        'descricao',
        'arquivo',
        'data_emissao',
        'aluno_id',
        'documento_id',
        'status'
    ];

    protected $dates = ['deleted_at', 'data_emissao'];

    protected $casts = [
        'status' => 'string'
    ];

    // Scopes
    public function scopePorAluno($query, $alunoId)
    {
        return $query->where('aluno_id', $alunoId);
    }

    public function scopePorDocumento($query, $documentoId)
    {
        return $query->where('documento_id', $documentoId);
    }

    public function scopePendentes($query)
    {
        return $query->where('status', 'pendente');
    }

    // Relacionamentos
    public function aluno()
    {
        return $this->belongsTo(Aluno::class)->withDefault();
    }

    public function documento()
    {
        return $this->belongsTo(Documento::class)->withDefault();
    }

    // Métodos
    public function getCaminhoArquivoAttribute()
    {
        return Storage::url($this->arquivo);
    }

    public function marcarComoVerificado()
    {
        $this->update(['status' => 'verificado']);
    }

    public function rejeitar($motivo)
    {
        $this->update([
            'status' => 'rejeitado',
            'descricao' => $this->descricao . "\nMotivo da rejeição: $motivo"
        ]);
    }
}