<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $create = Permission::create(['name' => 'create']);
        $read = Permission::create(['name' => 'read']);
        $update = Permission::create(['name' => 'update']);
        $delete = Permission::create(['name' => 'delete']);
        $play = Permission::create(['name' => 'play']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Permission::where('name', 'create')->first()->delete();
        Permission::where('name', 'read')->first()->delete();
        Permission::where('name', 'update')->first()->delete();
        Permission::where('name', 'delete')->first()->delete();
        Permission::where('name', 'play')->first()->delete();
    }
};
