<?php

namespace App\Http\Livewire\Reservations;

use App\Data\Repositories\Sectors;
use App\Models\User;
use Livewire\Component;

class Associate extends Component
{
    public function render()
    {
        dd(User::all()->where());
        return view('livewire.reservations.associate')->with($this->getComponentVariables());



    }

    protected function getComponentVariables()
    {

        return ['sectors' =>app(Sectors::class)->allVisitable()];
    }

}
