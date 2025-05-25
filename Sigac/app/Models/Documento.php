<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Documento extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'documentos';
    
    protected $fillable = [
        'titulo',
        'descricao',
        'arquivo',
        'data_emissao',
        'aluno_id',
        'categoria_id',
        'tipo',
        'validade',
        'status'
    ];

    protected $dates = [
        'deleted_at',
        'data_emissao',
        'validade'
    ];

    protected $casts = [
        'status' => 'string'
    ];

    // Scopes
    public function scopePorAluno($query, $alunoId)
    {
        return $query->where('aluno_id', $alunoId);
    }

    public function scopePorCategoria($query, $categoriaId)
    {
        return $query->where('categoria_id', $categoriaId);
    }

    public function scopeVencidos($query)
    {
        return $query->where('validade', '<', now());
    }

    public function scopeValidos($query)
    {
        return $query->where('validade', '>=', now())
                    ->orWhereNull('validade');
    }

    // Relacionamentos
    public function aluno()
    {
        return $this->belongsTo(Aluno::class)->withDefault();
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class)->withDefault();
    }

    public function comprovantes()
    {
        return $this->hasMany(Comprovante::class);
    }

    // Métodos
    public function getCaminhoArquivoAttribute()
    {
        return Storage::url($this->arquivo);
    }

    public function estaVencido()
    {
        return $this->validade && $this->validade->isPast();
    }

    public function marcarComoVerificado()
    {
        $this->update(['status' => 'verificado']);
    }

    public function renovarValidade($novaData)
    {
        $this->update(['validade' => $novaData]);
    }
}