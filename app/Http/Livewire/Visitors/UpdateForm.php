<?php

namespace App\Http\Livewire\Visitors;

use App\Http\Livewire\Traits\WithWebcam;
use App\Models\Person;
use App\Http\Livewire\BaseForm;
use App\Models\Sector;
use App\Models\Visitor;
use Livewire\WithFileUploads;

class UpdateForm extends Form
{
    public $mode = 'update';

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
