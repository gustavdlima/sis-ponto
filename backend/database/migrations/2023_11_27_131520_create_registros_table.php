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
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_funcionario');
            $table->bigInteger('id_horario');
            $table->dateTime('primeiro_ponto');
            $table->dateTime('segundo_ponto');
            $table->dateTime('terceiro_ponto');
            $table->dateTime('quarto_ponto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('registros', [
            'primeiro_ponto',
            'segundo_ponto',
            'terceiro_ponto',
            'quarto_ponto',
        ]);
    }
};
