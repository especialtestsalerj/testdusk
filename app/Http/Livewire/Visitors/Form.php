<?php

namespace App\Http\Livewire\Visitors;

use App\Data\Repositories\Sectors as SectorsRepository;
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

    public $sector_id;

    protected $listeners = [
        'personModified' => 'personModified',
        'cropChanged' => 'cropChanged',
    ];

    protected $rules = [
        'visitor.entranced_at' => 'required',
        'visitor.exited_at' => '',
        'visitor.sector_id' => 'required',
        'person.full_name' => '',
        'person.social_name' => '',
    ];

    public function updated($name, $value)
    {
        if ($name == 'sector_id') {
            $this->sector = Sector::find($value);
            $this->visitor->sector = $this->sector;
            $this->visitor->sector_id = $value;
        }
    }

    public function mount(Visitor $visitor)
    {
        if (empty($visitor->id)) {
            $this->visitor = new Visitor();
            $this->visitor->entranced_at = now();

            $this->person = new Person();

            if ($cpfParameter = request()->get('cpf')) {
                $this->person->cpf = $cpfParameter;
            }

            if ($nameParameter = request()->get('name')) {
                $this->person->name = $nameParameter;
            }

            $this->sector = new Sector();

            $this->webcam_data_uri = false;

            $this->visitor->append(['photo']);

            if ($this->visitor->photo == '/img/no-photo.svg') {
                $this->webcam_file = '';
            } else {
                $this->webcam_file = $this->visitor->photo;
            }
        } else {
            $this->visitor = $visitor;

            $this->person = $visitor->person;
            $this->sector = $visitor->sector;
        }
    }

    public function personModified($person)
    {
        $this->person = new Person();
        $this->person->fill($person);
    }

    protected function formVariables()
    {
        return [
            'sectors' => app(SectorsRepository::class)->allActive($this->visitor->sector_id),
        ];
    }

    public function render()
    {
        $this->visitor->person = $this->person;
        return view('livewire.visitors.form')->with($this->getViewVariables());
    }
}
