<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
           'name' => 'Telegram',
           'owner_name' => 'Pavel Durov',
           'phone_number' => '+998972333321'
        ]);

        Company::create([
            'name' => 'Tesla',
            'owner_name' => 'Elon Musk',
            'phone_number' => '+998972333321'
        ]);
    }
}
