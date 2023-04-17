<?php

namespace App\Http\Livewire\Events;

use App\Data\Repositories\Events as EventsRepository;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Http\Livewire\BaseIndex;

class Index extends BaseIndex
{
    protected $repository = EventsRepository::class;

    public $orderByField = ['occurred_at', 'id'];
    public $orderByDirection = [];
    public $paginationEnabled = true;
    public $routine_id;
    public $routine;
    public $redirect;

    public $searchFields = [
        'events.occurred_at' => 'date',
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
        return view('livewire.events.index')->with(['events' => $this->filter()]);
    }
}
