<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Permisos base (guard api)
        $perms = [
            'users.view','users.create','users.update','users.delete',
            'roles.view','roles.create','roles.update','roles.delete',
        ];
        foreach ($perms as $p) {
            Permission::firstOrCreate(['name' => $p, 'guard_name' => 'api']);
        }

        // Roles (guard api)
        $admin   = Role::firstOrCreate(['name' => 'admin',   'guard_name' => 'api']);
        $manager = Role::firstOrCreate(['name' => 'manager', 'guard_name' => 'api']);
        $user    = Role::firstOrCreate(['name' => 'user',    'guard_name' => 'api']);

        // Admin con todos los permisos
        $admin->syncPermissions(Permission::where('guard_name', 'api')->get());

        // Usuario administrador por defecto
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Administrador', 'password' => Hash::make('password')]
        );

        // Asignar rol admin
        $adminUser->assignRole('admin');
    }
}
