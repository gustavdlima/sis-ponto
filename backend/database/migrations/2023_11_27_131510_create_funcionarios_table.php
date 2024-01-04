<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('setor');
            $table->string('matricula');
            $table->integer('nivel');
            $table->date('data_nascimento')->nullable();
            $table->string('rg');
            $table->string('cpf');
            $table->string('pis_pasep');
            $table->string('titulo_eleitor');
            $table->string('cartao_sus')->nullable();
            $table->string('mae');
            $table->string('pai');
            $table->string('celular');
            $table->string('bairro');
            $table->string('rua');
            $table->string('numero');
            $table->string('cidade');
            $table->string('uf');
            $table->string('cep');
            $table->string('estado_civil');
            $table->string('email');
            $table->string('id_cargo')->nullable();
            $table->bigInteger('id_horario')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('funcionarios', [
            'nome',
            'setor',
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
            'id_cargo',
            'id_horario',
        ]);
    }
};
