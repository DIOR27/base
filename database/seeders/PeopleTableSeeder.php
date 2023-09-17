<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('people')->insert([
            'name' => 'LAVA',
            'lastname' => 'Admin',
            'phone' => '1234567890',
            'email' => 'admin@argon.com',
            'company_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
