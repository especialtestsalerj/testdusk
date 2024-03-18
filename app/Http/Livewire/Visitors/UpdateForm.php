<?php

namespace App\Http\Livewire\Visitors;

use App\Models\Contact;
use App\Models\Visitor;
class UpdateForm extends Form
{
    public $mode = 'show';

    public function mount(Visitor $visitor)
    {
        $this->visitor = $visitor;
        $this->person = $visitor->person;
        $this->document = $visitor->document;
        $this->card_id = $visitor->card_id;
        $this->contact = $this->person?->contacts?->first();
        $this->loadPhoto();
        $this->fillByOld();
    }
}
