<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ocorrencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'motivo_id',
        'descricao',
        'data',
        'tipo',
        'status'
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function motivo()
    {
        return $this->belongsTo(MotivoOcorrencia::class, 'motivo_id');
    }
}
