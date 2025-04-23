<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'telefone', 'curso_id', 'turma_id', 'senha'];


    // Relação com o curso
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    // Relação com a turma
    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }
}
