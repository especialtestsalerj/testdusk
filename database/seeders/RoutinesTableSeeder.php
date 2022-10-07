<?php

namespace Database\Seeders;

use Database\Factories\RoutinesFactory;
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
        app(RoutinesFactory::class)
        ->count(1)
        ->create();
    }
}
