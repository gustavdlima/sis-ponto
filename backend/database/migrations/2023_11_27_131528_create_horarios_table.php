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
            $table->time('horario_entrada');
            $table->time('horario_ida_intervalo');
            $table->time('horario_volta_intervalo');
            $table->time('horario_saida');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('horarios', [
            'horario_entrada',
            'horario_ida_intervalo',
            'horario_volta_intervalo',
            'horario_saida',
        ]);
    }
};
