<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'setor',
        'cargo',
        'matricula',
        'nivel',
        'data_nascimento',
        'rg',
        'cpf',
        'pis_pasep',
        'titulo_eleitor',
        'cartao_sus',
        'mae',
        'pai',
        'celular',
        'bairro',
        'rua',
        'numero',
        'cidade',
        'uf',
        'cep',
        'estado_civil',
        'email',
        'id_cargo'
        'id_horario',
    ];
}
