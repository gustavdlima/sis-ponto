<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';
    // protected $primaryKey = '';

    protected $fillable = [
        'id_funcionario',
        'horario_chegada',
        'horario_ida_almoco',
        'horario_volta_almoco',
        'horario_saida'
    ];
}
