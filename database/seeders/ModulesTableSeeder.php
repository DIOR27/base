<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //get all models in app/Models
        $models = glob(app_path('Models/*.php'));

        foreach ($models as $model) {

            \App\Models\Module::create([
                'name' => basename($model, '.php'),
            ]);
        }
    }
}
