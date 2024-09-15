<?php

namespace Database\Seeders;

use App\Models\Vacancy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

     Vacancy::create([
         'state' => 'open_vacancy',
         'company_id' => 1,
         'category_id' => 1,
         'name' => 'web designer',
     ]) ;

        Vacancy::create([
            'state' => 'open_vacancy',
            'company_id' => 2,
            'category_id' => 3,
            'name' => 'Truck driver',
        ]) ;
    }
}


