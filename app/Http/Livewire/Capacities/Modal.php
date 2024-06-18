<?php

namespace App\Http\Livewire\Capacities;

use App\Http\Livewire\BaseForm;
use App\Models\Capacity;
use App\Models\Sector;

class Modal extends BaseForm
{
    protected $listeners = ['editCapacity', 'createCapacity'];

    public $sector;

    public $capacity;
    public $sector_id;
    public $hour;
    public $maximum_capacity;

    public function createCapacity(Sector $sector)
    {
        $this->sector = $sector;
    }

    public function editCapacity(Capacity $capacity)
    {
        $this->capacity = $capacity;
        $this->sector_id = $capacity->sector_id;
        $this->hour = $capacity->hour;
        $this->maximum_capacity = $capacity->maximum_capacity;
    }


    public function render()
    {
        return view('livewire.capacities.modal');
    }

    public function cleanModal()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    public function store()
    {

        if($this->capacity){
            $this->storeEditCapacity();
            $this->emit('created-capacity', $this->capacity->sector);
            $this->swallSuccess('Horário alterado com sucesso');
        }else{
            $this->storeNewCapacity();
            $this->emit('created-capacity', $this->sector);
            $this->swallSuccess('Horário criado com sucesso');
        }
        $this->dispatchBrowserEvent('hide-modal', ['target' => 'capacity-modal']);
        $this->cleanModal();
    }

    private function storeNewCapacity()
    {

        $this->sector->Capacities()->create([
            'hour'=>$this->hour,
            'maximum_capacity'=>$this->maximum_capacity,
        ]);
    }

    private function storeEditCapacity()
    {
        $this->capacity->hour = $this->hour;
        $this->capacity->maximum_capacity = $this->maximum_capacity;
        $this->capacity->update();

    }
}
