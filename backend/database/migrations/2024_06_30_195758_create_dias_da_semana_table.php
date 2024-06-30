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
        Schema::create('dias_da_semana', function (Blueprint $table) {
            $table->id();
            $table->string('segunda')->nullable();
            $table->string('terca')->nullable();
            $table->string('quarta')->nullable();
            $table->string('quinta')->nullable();
            $table->string('sexta')->nullable();
            $table->string('sabado')->nullable();
            $table->string('domingo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dias_da_semana');
    }
};
