<?php
namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $person = Person::find(1)->first();

        DB::table('users')->insert([
            'id' => 1,
            'person_id' => $person->id,
            'company_id' => $person->company_id,
            'name' => $person->name,
            'lastname' => $person->lastname,
            'email' => $person->email,
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
