<?php

namespace App\Http\Livewire\Sectors;

use App\Models\Sector;
use Livewire\Component;
use Livewire\WithPagination;
use function view;

class Sectors extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.sectors.partials.table', [
            'sectors' => Sector::paginate(1),
        ]);
    }
}
