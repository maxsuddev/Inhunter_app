<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\User;
 use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            AppSeeder::class,
            LanguageSeeder::class,
            CompanySeeder::class,
            CategorySeeder::class,
           // VacancySeeder::class
        ]);
    }
}
