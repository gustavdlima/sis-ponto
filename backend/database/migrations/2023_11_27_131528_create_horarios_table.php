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
            $table->time('primeiro_horario')->nullable();
            $table->time('segundo_horario')->nullable();
            $table->time('terceiro_horario')->nullable();
            $table->time('quarto_horario')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('horarios', [
            'primeiro_horario',
            'segundo_horario',
            'terceiro_horario',
            'quarto_horario',
        ]);
    }
};
