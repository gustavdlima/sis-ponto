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
            'data_nascimento',
            'id_horario',
        ]);
    }
};
