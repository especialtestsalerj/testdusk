<?php

namespace Database\Factories;

use App\Models\Capacity;
use App\Models\Sector;
use Illuminate\Database\Eloquent\Factories\Factory;

class CapacityFactory extends Factory
{
    protected $model = Capacity::class;

    public function definition()
    {
        return [
            'sector_id' => function () {
                $sector = Sector::inRandomOrder()->first();
                if (!$sector) {
                    throw new \Exception('Nenhum setor encontrado para associar à capacity.');
                }
                return $sector->id;
            },
            'hour' => $this->faker->unique()->time('H:i'),
            'maximum_capacity' => $this->faker->numberBetween(10, 100),
            'created_by_id' => 1,
            'updated_by_id' => 1,
        ];
    }
}
