<?php

namespace App\Data\Repositories;

use App\Models\Visitor;

class Visitors extends Repository
{
    /**
     * @var string
     */
    protected $model = Visitor::class;

    public function findByRoutine($routine_id)
    {
        return $this->model::where('routine_id', $routine_id)->get();
    }
}
