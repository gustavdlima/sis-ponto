<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'primeiro_horario',
        'segundo_horario',
        'terceiro_horario',
        'quarto_horario',
    ];
}
