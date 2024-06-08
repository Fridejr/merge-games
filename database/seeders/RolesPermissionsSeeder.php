<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Obtener roles y asignar sus permisos
        $rolAdministrador = Role::where('name', 'administrador')->first();
        $rolAdministrador->givePermissionTo('create', 'read', 'update', 'delete', 'play');

        $rolJugador = Role::where('name', 'jugador')->first();
        $rolJugador->givePermissionTo('play');

        //Asignar rol de administrador a los usuarios deseados
        $users = User::whereIn('id', [1, 2, 3])->get();
        foreach ($users as $user) {
            $user->assignRole($rolAdministrador);
        }

        //Asignar rol de jugador al resto de usuarios
        $users = User::whereNotIn('id', [1, 2, 3])->get();
        foreach ($users as $user) {
            $user->assignRole($rolJugador);
        }
    }
}
