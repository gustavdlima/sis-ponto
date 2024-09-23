<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cargo;
use App\Models\DiasDaSemana;

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
        'id_dia_da_semana',
        'carga_horaria',
        'sexo',
        'deficiente',
    ];

    public function cargo()
    {
        return $this->hasOne(Cargo::class, 'id_cargo');
    }

    public function diasDaSemana()
    {
        return $this->belongsTo(DiasDaSemana::class, 'id_dia_da_semana');
    }

    public function registros()
    {
        return $this->hasMany(Registro::class, 'id_funcionario');
    }

}
