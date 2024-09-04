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
        Schema::table('faltas', function (Blueprint $table) {
            // Add columns
            $table->boolean('primeiro_turno')->nullable();
            $table->boolean('segundo_turno')->nullable();
            $table->boolean('terceiro_turno')->nullable();
            $table->boolean('quarto_turno')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faltas', function (Blueprint $table) {
            //
        });
    }
};
