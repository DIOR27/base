<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $scriptPath = public_path('sql/countries.sql');
        $sqlStatement = file_get_contents($scriptPath);

        DB::unprepared($sqlStatement);

    }
}
