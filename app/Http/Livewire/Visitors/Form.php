<?php

namespace App\Http\Livewire\Visitors;

use App\Models\Person;
use App\Http\Livewire\BaseForm;
use App\Models\Sector;
use App\Models\Visitor;

class Form extends BaseForm
{
    public Visitor $visitor;
    public $mode = 'create';
    public Sector $sector;
    public Person $person;

    protected $listeners = ['personModified' => 'personModified'];

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

    public function mount()
    {
        if ($this->mode == 'create') {
            $this->visitor = new Visitor();
            $this->visitor->entranced_at = now();

            $this->person = new Person();
            $this->sector = new Sector();
        } else {
            //            $this->person = $this->visitor->person;
            //            $this->sector = $this->visitor->sector;
            //update person...
        }

        $this->visitor->append(['photo']);
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
