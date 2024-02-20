<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_funcionario',
        'id_horario',
        'id_justificativa',
        'primeiro_ponto',
        'segundo_ponto',
        'terceiro_ponto',
        'quarto_ponto',
        'atrasou_primeiro_ponto',
        'atrasou_segundo_ponto',
        'atrasou_terceiro_ponto',
        'atrasou_quarto_ponto',
        'justificativa',
    ];
}
