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


      $admin = User::create([
            'name' => 'Dev User',
            'email' => 'developer@example.com',
            'password' => bcrypt('password'),
        ]);




        $adminRole = Role::where('name', 'admin')->first();
        $admin->syncRoles($adminRole);
     }
}
