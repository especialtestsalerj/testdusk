<?php

namespace Database\Seeders;

use Database\Factories\RoutineFactory;
use Illuminate\Database\Seeder;

class RoutinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i= 0; $i < 7; $i++) {
            app(RoutineFactory::class)
                ->create();
        }

    }
}
