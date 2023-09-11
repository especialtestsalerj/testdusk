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
        'visitor.person.*' => '',
        'person.full_name' => '',
        'person.social_name' => '',
        'hasWebcamPhoto' => '',
    ];

    public function updated($name, $value)
    {
        if ($name == 'sector_id') {
            $sector = empty($value) ? null : $value;
            if (!is_null($sector)) {
                $this->sector = Sector::find($sector);
                $this->visitor->sector = $this->sector;
                $this->visitor->sector_id = $sector;
            }
        }
    }

    public function mount(Visitor $visitor)
    {
        if (empty($visitor->id)) {
            $this->visitor = new Visitor();
            $this->visitor->entranced_at = now();

            $this->person = new Person();

            $this->fillByQueryString();

            $this->sector = new Sector();

            $this->loadPhoto();
        } else {
            $this->visitor = $visitor;

            $this->loadPhoto();

            $this->person = $visitor->person;
            $this->sector = $visitor->sector;
        }
    }

    public function personModified($person)
    {
        $this->person = new Person();
        $this->person->fill(is_array($person) ? $person : $person->toArray());
        $this->visitor->person = $person;
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

    /**
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function fillByQueryString(): void
    {
        if ($cpfParameter = request()->get('cpf')) {
            $this->person->cpf = $cpfParameter;
        }

        if ($nameParameter = request()->get('name')) {
            $this->person->name = $nameParameter;
        }

        $this->fillPersonByQueryString();
    }

    /**
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function fillPersonByQueryString(): void
    {
        if ($personId = request()->get('person_id')) {
            $this->personModified(Person::findOrFail($personId));
        }
    }

    /**
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function loadPhoto(): void
    {
        if ($person_id = request()->get('person_id')) {
            $this->visitor->person_id = $person_id;
        }

        $this->visitor->append(['photo']);

        $this->webcam_file = $this->photo = is_null(old('photo'))
            ? $this->visitor->photo
            : old('photo');

        $this->hasWebcamPhoto = (bool)$this->photo;

        $this->webcam_data_uri = ($this->photo ? true : false);
    }
}
