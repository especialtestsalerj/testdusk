<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sector;
use App\Models\Capacity;

class CapacitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        // Recupera todos os setores existentes
        $sectors = Sector::all();

        if ($sectors->isEmpty()) {
            $this->command->info('Nenhum setor encontrado. Capacities não serão criadas.');
            return;
        }

        // Itera sobre cada setor
        $sectors->each(function ($sector) {
            // Decide aleatoriamente se o setor receberá capacities
            if (rand(0, 1)) { // 50% de chance
                $capacityCount = rand(2, 5);
                // Cria capacities associadas ao setor atual
                Capacity::factory()
                    ->count($capacityCount)
                    ->create([
                        'sector_id' => $sector->id,
                    ]);
                if (rand(0, 1)) {
                    $sector->update(['is_visitable' => true]);
                }
            }
        });
    }
}
