<?php

namespace App\Http\Livewire\Cautions;

use App\Data\Repositories\Cautions as CautionsRepository;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Http\Livewire\BaseIndex;

class Index extends BaseIndex
{
    protected $repository = CautionsRepository::class;

    public $orderByField = 'started_at';
    public $orderByDirection = 'asc';
    public $paginationEnabled = true;
    public $routine_id;
    public $routine;

    public $searchFields = [
        'cautions.started_at' => 'date',
    ];

    public function mount()
    {
        $params = \Route::getCurrentRoute()->parameters();
        $this->routine_id = $params['routine_id'];
        $this->routine = app(RoutinesRepository::class)->findById([$this->routine_id]);
    }

    public function additionalFilterQuery($query)
    {
        return $query->where('routine_id', $this->routine_id);
    }

    public function render()
    {
        return view('livewire.cautions.index')->with(['cautions' => $this->filter()]);
    }
}
