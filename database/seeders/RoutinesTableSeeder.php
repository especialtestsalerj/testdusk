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
        app(RoutineFactory::class)
        ->count(7)
        ->create();
    }
}
