<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $manager = Role::create(['name' => 'manager']);
        $employee = Role::create(['name' => 'employee']);

        $permissions = [
            // Users
            'index-users' => ['manager', 'employee'], //2
            'show-users' => ['manager', 'employee'], //2
            'create-user' => ['manager'], //M

            // Vacancies
            'users-vacancies' => ['manager', 'employee'], //E
            'users-candidate' => ['manager', 'employee'], //E
            'candidates-owner' => ['employee'], //E

            // Roles
            'index-roles' => ['manager'], //M

            // Permissions
            'index-permissions' => ['manager'], //M

            // Candidates
            'index-candidates' => ['manager', 'employee'], //2
            'create-candidates' => ['employee'], //E
            'show-candidates' => ['employee'], //E
            'update-candidates' => ['employee'], //E

            // Companies
            'index-companies' => ['manager', 'employee'], //2
            'create-companies' => ['manager'], //M
            'show-companies' => ['manager'], //M
            'update-companies' => ['manager'], //M
            'delete-companies' => ['manager'], //M

            // Categories
            'index-categories' => ['manager', 'employee'], //2
            'create-categories' => ['manager'], //M
            'show-categories' => ['manager'], //M
            'update-categories' => ['manager'], //M
            'delete-categories' => ['manager'], //M

            // Vacancies
            'index-vacancies' => ['manager', 'employee'], //2
            'create-vacancies' => ['manager'], //M
            'show-vacancies' => ['manager', 'employee'], //2
            'change-state' => ['employee'], //E
            'update-vacancies' => ['employee'], //E
        ];

        foreach ($permissions as $permissionName => $roles) {
            $permission = Permission::create(['name' => $permissionName]);

            foreach ($roles as $roleName) {
                $role = Role::where('name', $roleName)->first();
                $role->givePermissionTo($permission);
            }
        }

        $this->command->info('Manager va Employee rollari va permissionlari muvaffaqiyatli yaratildi!');
    }
}
