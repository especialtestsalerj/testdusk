<?php

namespace App\Http\Livewire\Visitors;

use App\Models\Visitor;
class UpdateForm extends Form
{
    public $mode = 'show';

    public function mount(Visitor $visitor)
    {
        $this->visitor = $visitor;
        $this->person = $visitor->person;

        $this->loadPhoto();
    }
}
