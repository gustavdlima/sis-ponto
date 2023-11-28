<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'horario_entrada',
        'horario_ida_intervalo',
        'horario_volta_intervalo',
        'horario_saida',
    ];
}
