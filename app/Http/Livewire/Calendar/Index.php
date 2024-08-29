<?php

namespace App\Http\Livewire\Calendar;

use Livewire\Component;

class Index extends Component
{

    public $currentMonth;

    public function mount()
    {
        $this->currentMonth = now()->startOfMonth();
    }

    public function render()
    {
        return view('livewire.calendar.index')
            ->layout('layouts.app-talwind');
    }

    public function nextMonth()
    {
        $this->currentMonth = $this->currentMonth->addMonth();
        $this->emit('nextMonth');
    }

    public function previousMonth()
    {
        $this->currentMonth = $this->currentMonth->subMonth();
        $this->emit('previousMonth');
    }


}
