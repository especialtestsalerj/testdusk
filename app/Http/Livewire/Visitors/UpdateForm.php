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
        $this->webcam_data_uri = true;

        $this->visitor->append(['photo']);

        if ($this->visitor->photo == "/img/no-photo.svg") {
            $this->webcam_file = "";
        } else {
            $this->webcam_file = $this->visitor->photo;
        }

    }
}
