<?php

namespace App\Data\Repositories;

use App\Models\Building;

class Buildings extends Repository
{
    /**
     * @var string
     */
    protected $model = Building::class;

    public function getMainBuilding()
    {
        return \Cache::remember('main-building', 60, function () {
            return Building::where('slug', 'lucio-costa')->first();
        });
    }
}
