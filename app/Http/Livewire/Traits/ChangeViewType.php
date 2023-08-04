<?php

namespace App\Http\Livewire\Traits;

trait ChangeViewType
{
    public $showCard = true;

    public function showCard()
    {
        $this->showCard = true;
    }

    public function showTable()
    {
        $this->showCard = false;
    }
}
