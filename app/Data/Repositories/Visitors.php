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

    public function findByRoutineWithoutPending($routine_id, $visitor_id = null)
    {
        return $this->model
            ::where('routine_id', $routine_id)
            ->whereNull('old_id')
            ->whereRaw(isset($visitor_id) ? 'id = ' . $visitor_id : '1=1')
            ->get();
    }

    public function findByOldId($old_id)
    {
        return $this->model
            ::where('old_id', $old_id)
            ->whereNotNull('old_id')
            ->get();
    }

    public function findOld($routine_id, $old_id)
    {
        return $this->model
            ::where('routine_id', $routine_id)
            ->where('old_id', $old_id)
            ->whereNotNull('old_id')
            ->get();
    }
}
