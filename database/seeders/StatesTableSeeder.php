<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $scriptPath=public_path('sql/states_ec.sql');
        $sqlStatement=file_get_contents($scriptPath);

        DB::unprepared($sqlStatement);
    }
}
