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
            $table->date('primeiro_ponto');
            $table->date('segundo_ponto');
            $table->date('terceiro_ponto');
            $table->date('quarto_ponto');
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
