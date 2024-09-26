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
    public function run()
    {
        // Permissionlarni yaratish
        $permissions = [
            // Users
            'index-users',
            'show-users',
            'create-user',

            // Vacancies
            'users-vacancies',
            'users-candidate',
            'candidates-owner',

            // Roles
            'index-roles',

            // Permissions
            'index-permissions',

            // Candidates
            'index-candidates',
            'create-candidates',
            'show-candidates',
            'update-candidates',

            // Companies
            'index-companies',
            'create-companies',
            'show-companies',
            'update-companies',
            'delete-companies',

            // Categories
            'index-categories',
            'create-categories',
            'show-categories',
            'update-categories',
            'delete-categories',

            // Vacancies
            'index-vacancies',
            'create-vacancies',
            'show-vacancies',
            'change-state',
            'update-vacancies',
        ];

        foreach ($permissions as $permissionName) {
            Permission::create(['name' => $permissionName]);
        }

        $this->command->info('Barcha permissionlar muvaffaqiyatli yaratildi!');
    }
}
