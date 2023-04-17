<?php

namespace App\Http\Livewire\EventTypes;

use App\Data\Repositories\EventTypes as EventTypesRepository;
use App\Http\Livewire\BaseIndex;

class Index extends BaseIndex
{
    protected $repository = EventTypesRepository::class;

    public $orderByField = ['name', 'id'];
    public $orderByDirection = [];
    public $paginationEnabled = true;

    public $searchFields = [
        'event_types.name' => 'text',
    ];

    public function render()
    {
        return view('livewire.event-types.index')->with(['eventTypes' => $this->filter()]);
    }
}
