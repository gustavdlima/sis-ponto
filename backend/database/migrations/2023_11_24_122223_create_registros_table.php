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
            $table->integer('id_funcionario')->unsigned;
            $table->foreign('id_funcionario')->references('id')->on('funcionarios');
            $table->integer('id_horario')->unsigned;
            $table->foreign('id_horario')->references('id')->on('horarios');
            $table->time('ponto_0');
            $table->time('ponto_1');
            $table->time('ponto_2');
            $table->time('ponto_3');
            $table->date('dia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};
