<?php

namespace App\Http\Livewire\People;

use App\Data\Repositories\Documents;
use App\Data\Repositories\DocumentTypes;
use App\Data\Repositories\PersonRestrictions as PersonRestrictionsRepository;
use App\Http\Livewire\BaseForm;
use App\Http\Livewire\Traits\Addressable;
use App\Models\City;
use App\Models\Country;
use App\Models\DocumentType;
use App\Models\Person;
use App\Models\State;
use App\Http\Livewire\Traits\WithWebcam;
use App\Models\Visitor;
use Livewire\WithFileUploads;

use function app;
use function info;
use function view;

class People extends BaseForm
{
    use Addressable;

    protected $listeners = [
        'snapshotTaken' => 'updatePJFile',
    ];

    public $person;
    public $person_id;
    public $document_number;
    public $state_document_id;
    public $full_name;
    public $social_name;

    public $document_type_id;

    public $routineStatus;
    public $modal;
    public $readonly;
    public $showRestrictions = false;
    public $alerts = [];

    public $visitor_id;
    public $visitor;

    protected $rules = [
        'country_id' => 'required',
        'other_city' => 'required',
    ];

    public function updated($name, $value)
    {
        $person = new Person();
        $person->fill([
            'full_name' => convert_case($this->full_name, MB_CASE_UPPER),
            'social_name' => convert_case($this->social_name, MB_CASE_UPPER),
            'document_number' => $this->document_number,
            'document_type_id' => $this->document_type_id,
            'state_document_id' => $this->state_document_id,
        ]);
        $this->emit('personModified', $person);
    }

    public function searchDocumentNumber()
    {
        if (!is_null($this->document_number) && $this->document_number != '') {
            $document = app(Documents::class)->findByNumber(
                remove_punctuation($this->document_number)
            );

            if (!is_null($document)) {
                $this->person = $document->person;
                $this->person_id = $this->person->id;
                $this->fillModel();
                $this->document_number = convert_case(
                    remove_punctuation($document->number),
                    MB_CASE_UPPER
                );
                $this->document_type_id = $document->document_type_id;
                $this->state_document_id = $document->state_id;
                $this->setAddressReadOnly(true);
                $this->readonly = true;
            } else {
                $this->person = new Person();
                $this->readonly = false;
            }
        }

        $this->updated('document_number', $this->document_number);
    }

    public function isPreFilled($fieldName)
    {
        //filled by prop in query string
        return is_null(old($fieldName)) && $this->{$fieldName};
    }

    public function fillModel()
    {
        $this->alerts = [];
        if (!is_null($this->person_id)) {
            $this->person = Person::where('id', $this->person_id)->first();
            $this->document_number = $document_number = convert_case(
                remove_punctuation($this->person->documents[0]->number),
                MB_CASE_UPPER
            );

            $this->readonly = true;
        } else {
            if (!$this->isPreFilled('document_number')) {
                $document_number = is_null(old('document_number'))
                    ? mask_cpf($this->person->cpf) ?? ''
                    : mask_cpf(old('document_number'));

                $this->document_number = convert_case(
                    remove_punctuation($document_number),
                    MB_CASE_UPPER
                );
            }
        }

        if (!$this->isPreFilled('document_type_id')) {
            $this->document_type_id = is_null(old('document_type_id'))
                ? $this->document_type_id
                : old('document_type_id');
        }

        $this->state_document_id = is_null(old('state_document_id'))
            ? $this->state_document_id
            : old('state_document_id');

        $this->person_id = is_null(old('person_id')) ? $this->person->id : old('person_id');

        if (!$this->isPreFilled('full_name')) {
            $this->full_name = is_null(old('full_name'))
                ? convert_case($this->person->full_name, MB_CASE_UPPER)
                : old('full_name');
        }

        $this->social_name = is_null(old('social_name'))
            ? convert_case($this->person->social_name, MB_CASE_UPPER)
            : old('social_name');

        $this->fillAddress();

        if ($this->showRestrictions) {
            $restrictions = app(PersonRestrictionsRepository::class)->getRestrictions(
                remove_punctuation($this->document_number)
            );

            foreach ($restrictions as $restriction) {
                array_push($this->alerts, $restriction->message);
            }
        }
    }

    public function mount($person_id)
    {
        if ($this->mode == 'create') {
            $this->person = new Person();
        }

        $this->fillModel();
        $this->loadDefault();
    }

    public function render()
    {
        $this->loadCountryBr();

        return view('livewire.people.partials.person')->with($this->getViewVariables());
    }

    protected function formVariables()
    {
        return array_merge($this->addressFormVariables(), [
            'documentTypes' => app(DocumentTypes::class)->allOrderBy('name', 'asc', null),
        ]);
    }

    public function openModal()
    {
        $this->dispatchBrowserEvent('openDocumentModalFOrm');
    }

    public function loadDefault()
    {
        if (is_null($this->document_type_id)) {
            $this->document_type_id = DocumentType::where('name', '=', 'CPF')->first()->id;
        }

        $this->loadDefaultLocation();
    }

    /**
     * @return void
     */
    public function loadDefaultLocation(): void
    {
        if (is_null($this->country_id)) {
            $this->country_id = Country::where('id', '=', config('app.country_br'))->first()->id;
            $this->select2SelectOption('country_id', $this->country_id);
        }
        if (is_null($this->state_id)) {
            $this->state_id = State::where('id', '=', config('app.state_rj'))->first()->id;
            $this->select2SelectOption('state_id', $this->state_id);
        }
        if (is_null($this->city_id)) {
            $this->city_id = City::where('id', '=', config('app.city_rio'))->first()->id;
            $this->loadCities();
        }
    }
}
