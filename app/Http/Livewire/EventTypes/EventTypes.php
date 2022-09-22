<?php

namespace App\Http\Livewire\EventTypes;

use App\Models\EventType;
use Livewire\Component;
use Livewire\WithPagination;
use function view;

class Eventtypes extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.event_types.partials.table', [
            'eventTypes' => EventType::paginate(1),
        ]);
    }
}
