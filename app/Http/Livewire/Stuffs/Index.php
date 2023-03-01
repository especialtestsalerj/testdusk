<?php

namespace App\Http\Livewire\Stuffs;

use App\Data\Repositories\Stuffs as StuffsRepository;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Http\Livewire\BaseIndex;

class Index extends BaseIndex
{
    protected $repository = StuffsRepository::class;

    public $orderByField = 'entranced_at';
    public $orderByDirection = 'asc';
    public $paginationEnabled = true;
    public $routine_id;
    public $routine;

    public $searchFields = [
        'stuffs.entranced_at' => 'date',
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
        return view('livewire.stuffs.index')->with(['stuffs' => $this->filter()]);
    }
}
