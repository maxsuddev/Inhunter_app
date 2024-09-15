<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $admin1 =   User::create([
            'name' => 'Developer',
            'email' => 'developer@example.com',
            'password' => bcrypt('password'),
        ]);

        $admin =  User::create([
          'name' => 'Admin',
          'email' => 'admin@example.com',
          'password' => bcrypt('password'),
      ]);

        User::create([
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);




        $adminRole = Role::where('name', 'admin')->first();
        $admin->syncRoles($adminRole);
        $admin1->syncRoles($adminRole);
     }
}
