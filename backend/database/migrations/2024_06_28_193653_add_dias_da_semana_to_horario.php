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
        Schema::table('horarios', function (Blueprint $table) {
            $table->string('segunda')->nullable();
            $table->string('terca')->nullable();
            $table->string('quarta')->nullable();
            $table->string('quinta')->nullable();
            $table->string('sexta')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('horarios', function (Blueprint $table) {
            $table->dropColumn('segunda');
            $table->dropColumn('terca');
            $table->dropColumn('quarta');
            $table->dropColumn('quinta');
            $table->dropColumn('sexta');
        });
    }
};
