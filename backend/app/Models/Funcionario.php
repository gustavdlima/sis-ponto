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
        'matricula',
        'data_nascimento',
        'rg',
        'cpf',
        'pis_pasep',
        'titulo_eleitor',
        'cartao_sus',
        'mae',
        'pai',
        'celular',
        'email',
        'estado_civil',
        'rua',
        'bairro',
        'cep',
        'numero',
        'cidade',
        'uf',
        'id_cargo',
        'id_horario',
        'carga_horaria',
    ];
}
