<?php

namespace App\Http\Livewire\Reservations;

use App\Data\Repositories\Sectors;
use App\Data\Repositories\Users;
use App\Models\User;
use Livewire\Component;

class Associate extends Component
{
    public function render()
    {
        $users = app(Users::class)->allWithAbility(make_ability_name_with_current_building('reservation:show'));

        foreach($users as $user){
            dump('nome '. $user->name . $user->getAbilities());
        }



        return view('livewire.reservations.associate')->with($this->getComponentVariables());



    }

    protected function getComponentVariables()
    {

        return ['sectors' =>app(Sectors::class)->allVisitable()];
    }

}
