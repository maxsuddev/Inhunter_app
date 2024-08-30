<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'get-all-roles',
            'create-roles',
            'update-roles',
            'delete-roles',
            'add-role-permissions',
            'get-all-permissions',
            'create-permissions',
            'update-permissions',
            'delete-permissions',
            'get-all-users',
            'create-users',
            'update-users',
            'delete-users',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->givePermissionTo($permissions);
    }
}
