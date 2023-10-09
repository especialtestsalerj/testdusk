<?php

namespace App\Http\Livewire\Visitors;

use App\Data\Repositories\Sectors as SectorsRepository;
use App\Http\Livewire\Traits\WithWebcam;
use App\Models\Document;
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
    public Document $document;

    public $person_id;
    public $sector_id;

    protected $listeners = [
        'personModified' => 'personModified',
        'cropChanged' => 'cropChanged',
    ];

    protected $rules = [
        'visitor.entranced_at' => 'required',
        'visitor.exited_at' => '',
        'visitor.sector_id' => 'required',
        'visitor.avatar_id' => 'required',
        'visitor.person.*' => '',
        'visitor.person_id' => '',
        'person.full_name' => '',
        'person.social_name' => '',
        'sector_id' => '',
        'entranced_at' => '',
        'hasWebcamPhoto' => '',
        'webcamFile' => '',
        'webcamDataUri' => '',
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
        $this->visitor = new Visitor();

        $this->visitor->entranced_at = old('entranced_at') ?: now();

        $this->fillByOld();

        $this->person = new Person();
        $this->sector = new Sector();

        $this->fillByQueryString();

        $this->loadPhoto();
    }

    public function personModified($array)
    {
        $refreshPhoto = $array['refreshPhoto'];
        unset($array['refreshPhoto']);
        $person = $array;

        $this->person = new Person();
        $this->person->fill(is_array($person) ? $person : $person->toArray());
        $this->visitor->person = $person;

        $this->visitor->person_id = $person['id'];

        if ($refreshPhoto) {
            $this->loadPhoto();
        }
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

        $this->fillPersonByQueryStringOrOld();
    }

    /**
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function fillPersonByQueryStringOrOld(): void
    {
        $documentId = request()->get('document_id') ?? old('document_id');

        if ($documentId) {
            $this->document = Document::findOrFail($documentId);

            $this->person_id = $this->document->person_id;

            $this->personModified(Person::findOrFail($this->person_id));
        }
    }

    /**
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function loadPhoto(): void
    {
        if ($person_id = $this->person_id) {
            $this->visitor->person_id = $person_id;
            if ($this->visitor->person->photo !== no_photo()) {
                $this->visitor->loadLatestPhoto();
            }
        } else {
            $this->visitor->loadLatestPhoto();
            $this->visitor->append(['photo']);
        }

        $this->webcamFile = is_null(old('photo')) ? $this->visitor->photo : old('photo');

        $this->hasWebcamPhoto = $this->webcamFile != no_photo();
        $this->webcamDataUri = !!$this->webcamFile;

        $this->mountCoordinates();
    }

    /**
     * @return void
     */
    protected function fillByOld(): void
    {
        if ($oldValue = old('sector_id')) {
            $this->sector_id = $oldValue;
            $this->visitor->sector_id = $oldValue;
        }
        if ($oldValue = old('description')) {
            $this->visitor->description = $oldValue;
        }
        if ($oldValue = old('exited_at')) {
            $this->visitor->exited_at = $oldValue;
        }
    }
}
