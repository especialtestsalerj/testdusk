<?php

namespace App\Data\Repositories;

use App\Models\Routine;

class Routines extends Repository
{
    /**
     * @var string
     */
    protected $model = Routine::class;

    public function hasRoutineOpened()
    {
        return Routine::where('status', true)->count() > 0;
    }
}
