<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $table = 'registros';
    // protected $primaryKey = '';

    protected $fillable = [
        'id_funcionario',
        'id_horario',
        'ponto_0',
        'ponto_1',
        'ponto_2',
        'ponto_3',
        'dia'
    ];
}
