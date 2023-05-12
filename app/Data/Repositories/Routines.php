<?php

namespace App\Data\Repositories;

use App\Models\Routine;
use Illuminate\Support\Facades\DB;

class Routines extends Repository
{
    /**
     * @var string
     */
    protected $model = Routine::class;

    //Return the next code of the new caution
    public function makeCode()
    {
        return (DB::table('routines')->max('code') ?? 0) + 1;
    }

    public function hasRoutineOpened()
    {
        return Routine::where('status', true)->count() > 0;
    }
}
