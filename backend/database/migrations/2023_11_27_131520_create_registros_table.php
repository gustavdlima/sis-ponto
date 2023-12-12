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
            $table->bigInteger('id_funcionario')->nullable();
            $table->bigInteger('id_horario')->nullable();
            $table->dateTime('primeiro_ponto')->nullable();
            $table->dateTime('segundo_ponto')->nullable();
            $table->dateTime('terceiro_ponto')->nullable();
            $table->dateTime('quarto_ponto')->nullable();
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
