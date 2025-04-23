<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ocorrencia;

class MotivoOcorrencia extends Model
{
    use HasFactory;

    protected $table = 'motivos_ocorrencias';

    protected $fillable = ['nome', 'gravidade'];


    public function ocorrencias()
    {
        return $this->hasMany(Ocorrencia::class, 'motivo_id');
    }
}
