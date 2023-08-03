<?php

namespace App\Http\Livewire\Visitors;

use App\Http\Livewire\Traits\WithWebcam;
use App\Models\Person;
use App\Http\Livewire\BaseForm;
use App\Models\Sector;
use App\Models\Visitor;
use Livewire\WithFileUploads;

class Form extends BaseForm
{
    use WithWebcam;
    use WithFileUploads;

    public Visitor $visitor;
    public $mode = 'create';
    public Sector $sector;
    public Person $person;


    protected $listeners = [
        'personModified' => 'personModified',
        'cropChanged' => 'cropChanged'
    ];

    protected $rules = [
        'visitor.entranced_at' => 'required',
        'visitor.sector_id' => 'required',
        'person.full_name' => '',
        'person.social_name' => '',
    ];

    public function updated($name, $value)
    {
        if ($name == 'visitor.sector_id') {
            $this->sector = Sector::find($value);
        }
    }

    public function mount(Visitor $visitor)
    {

        $this->visitor = new Visitor();
        $this->visitor->entranced_at = now();

        $this->person = new Person();
        $this->sector = new Sector();

        $this->webcam_data_uri = false;


        $this->visitor->append(['photo']);

        if ($this->visitor->photo == "/img/no-photo.svg") {
            $this->webcam_file = "";
        } else {
            $this->webcam_file = $this->visitor->photo;
        }
    }

    public function personModified($person)
    {
        $this->person = new Person();
        $this->person->fill($person);
    }

    protected function formVariables()
    {
        return ['sectors' => Sector::all()];
    }

    public function render()
    {
        $this->visitor->person = $this->person;
        return view('livewire.visitors.form')->with($this->getViewVariables());
    }
}
