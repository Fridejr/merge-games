<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin2@admin.com',
            'password' => Hash::make('admin'),
        ]);
        User::factory()->create([
            'name' => 'Developer',
            'email' => 'admin3@admin.com',
            'password' => Hash::make('admin'),
        ]);


        $this->call(UserSeeder::class);
        $this->call(ConsolaSeeder::class);
        $this->call(RolesPermissionsSeeder::class);
    }
}
