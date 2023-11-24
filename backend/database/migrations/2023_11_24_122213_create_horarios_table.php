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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->integer('id_funcionario')->unsigned;
            $table->foreign('id_funcionario')->references('id')->on('funcionarios');
            $table->time('horario_chegada');
            $table->time('horario_ida_almoco');
            $table->time('horario_volta_almoco');
            $table->time('horario_saida');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'horarios',
        );
    }
};
