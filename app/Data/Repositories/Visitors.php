<?php

namespace App\Data\Repositories;

use App\Models\Visitor;

class Visitors extends Repository
{
    /**
     * @var string
     */
    protected $model = Visitor::class;

    public function getLatestCheckouts()
    {
        return $this->model
            ::whereNotNull('exited_at')
            ->orderBy('exited_at', 'desc')
            ->paginate();
    }

    public function allNotExited($visitor_id = null)
    {
        return $this->model
            ::with('person')
            ->where(function ($query) use ($visitor_id) {
                $query->when(isset($visitor_id), function($query) use($visitor_id){
                    $query->orWhere('id', '=', $visitor_id);
                })->orWhereNull('exited_at');
            })
            ->get()
            ->sortBy(function ($row) {
                return $row->person->full_name;
            });
    }

    public function findByRoutineWithoutPending($visitor_id = null)
    {
        return $this->model::whereRaw(isset($visitor_id) ? 'id = ' . $visitor_id : '1=1')->get();
    }

    public function getAnonymousVisitor($entrance = null)
    {
        $visitor = new Visitor();
        $visitor->entranced_at = $entrance ?? now();
        return $visitor;
    }
}
