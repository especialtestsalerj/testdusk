<?php

namespace Database\Seeders;

use Database\Factories\SectorFactory;
use Illuminate\Database\Seeder;

class SectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        app(SectorFactory::class)
            ->count(50)
            ->create();
    }
}
