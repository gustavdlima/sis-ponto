<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Falta extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_funcionario',
        'id_justificativa',
        'data',
        'data2'
    ];

}
