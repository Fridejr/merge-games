<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $administrador = Role::create(['name' => 'administrador']);
        $jugador = Role::create(['name' => 'jugador']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Role::where('name', 'administrador')->first()->delete();
        Role::where('name', 'jugador')->first()->delete();
    }
};
