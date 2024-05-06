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
        Schema::create('tableros_consolas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tablero_id')->constrained();
            $table->foreignId('consola_id')->constrained();
            $table->integer('posicion')->required();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tableros_consolas');
    }
};
