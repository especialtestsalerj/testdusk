<?php

namespace Database\Seeders;

use Database\Factories\EventTypeFactory;
use Illuminate\Database\Seeder;

class EventTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        app(EventTypeFactory::class)
            ->count(7)
            ->create();
    }
}
