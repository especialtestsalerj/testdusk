<?php

namespace App\Http\Livewire\Reservations;

use App\Http\Livewire\Reservation\Form;
use Livewire\Component;

class FormGroup extends Form
{
    public function render()
    {
        return view('livewire.reservations.form-group');
    }
}
