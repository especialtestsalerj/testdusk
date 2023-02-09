<?php

namespace Database\Seeders;

use Bouncer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BouncerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bouncer::allow('Administrator')->everything();

        Bouncer::allow('ADMIN')->everything();

        Bouncer::allow('GESTOR')->everything();

        Bouncer::allow('PLANTONISTA')->everything();

    }
}
