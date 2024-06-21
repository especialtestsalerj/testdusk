<?php

namespace App\Http\Livewire\BlockedDates;

use App\Http\Livewire\BaseForm;
use App\Models\Sector;
use Livewire\Component;

class Modal extends BaseForm
{
    protected $listeners = ['createBlockedDate'];
    public $date;

    public $sector;

    public function render()
    {
        return view('livewire.blocked-dates.modal');
    }

    public function createBlockedDate(Sector $sector)
    {
        $this->sector = $sector;
    }

    public function cleanModal()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    public function store()
    {
        $this->sector->blockedDates()->create([
            'date'=>$this->date
        ]);
        $this->dispatchBrowserEvent('hide-modal', ['target' => 'blocked-date-modal']);
        $this->cleanModal();
        $this->emit('created-blocked-date', $this->sector);
        $this->swallSuccess('Nova Data Indisponível criada com sucesso.');
    }

}
