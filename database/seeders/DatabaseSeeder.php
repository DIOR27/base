<?php
namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        
        DB::table('users')->truncate();
        DB::table('people')->truncate();
        DB::table('cities')->truncate();
        DB::table('states')->truncate();
        DB::table('countries')->truncate();
        DB::table('companies')->truncate();

        $this->call([
            CountriesTableSeeder::class,
            StatesTableSeeder::class,
            CitiesTableSeeder::class,
            CompaniesTableSeeder::class,
            PeopleTableSeeder::class,
            UsersTableSeeder::class,
        ]);

        DB::statement("SET foreign_key_checks=1");
    }
}
