<?php

namespace App\Data\Repositories;

use App\Models\Visitor;

class Visitors extends Repository
{
    /**
     * @var string
     */
    protected $model = Visitor::class;

    public function allNotExited()
    {
        return $this->model
            ::with('person')
            ->whereNull('exited_at')
            ->get()
            ->sortBy(function ($row) {
                return $row->person->full_name;
            });
    }

    public function findByRoutineWithoutPending($visitor_id = null)
    {
        return $this->model::whereRaw(isset($visitor_id) ? 'id = ' . $visitor_id : '1=1')->get();
    }

    public function getAnonymousVisitor($entrance)
    {
        $visitor = new Visitor();
        $visitor->entranced_at = $entrance ?? now();
        return $visitor;
    }
}
