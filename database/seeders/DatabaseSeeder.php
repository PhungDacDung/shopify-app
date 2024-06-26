<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(users::class);
        // $this->call(insert_effect_templates::class);
        $this->call(create_plan_data::class);

        if (config('variables.WITH_FAKER')) {
            // FAKE data
        }
    }
}
