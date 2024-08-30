<?php

namespace Database\Seeders;

use App\Models\App;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        App::create([
           'name' => 'Word'
        ]);
        App::create([
            'name' => 'Exel'
        ]);

        App::create([
            'name' => 'Power Point'
        ]);

    }
}
