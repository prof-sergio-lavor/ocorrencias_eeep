<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    // Define os campos que podem ser preenchidos em massa (via create ou fill)
    protected $fillable = [
        'nome',
        'email',
        'senha',
        'telefone',
        'tipo',
        'foto'
    ];
}
