<?php

namespace App\Http\Livewire\Agendamento;

use App\Data\Repositories\Buildings;
use App\Http\Livewire\BaseIndex;
use Livewire\Component;

class Index extends BaseIndex
{

    public $buildings;


    public function mount()
    {
        $this->buildings = app(Buildings::class)->allActive();
    }

    public function render()
    {
        return view('livewire.agendamento.index');
    }
}
