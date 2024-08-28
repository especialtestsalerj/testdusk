<?php

namespace App\Http\Livewire\People;

use App\Data\Repositories\Documents;
use App\Data\Repositories\DocumentTypes;
use App\Data\Repositories\PersonRestrictions as PersonRestrictionsRepository;
use App\Http\Livewire\BaseForm;
use App\Http\Livewire\Traits\Addressable;
use App\Http\Livewire\Traits\Maskable;
use App\Models\City;
use App\Models\Country;
use App\Models\Document;
use App\Models\Person;
use App\Models\State;

use function app;
use function info;
use function view;

class People extends BaseForm
{
    use Addressable;
    use Maskable;

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
    public $contact;

    protected $messages = [
        'required' => ':attribute: preencha o campo corretamente.',
        'required_if' => ':attribute: preencha o campo corretamente.',
        'required_unless' => ':attribute: preencha o campo corretamente.',
    ];

    public function updated($name, $value)
    {
        $array = [
            'id' => $this->person->id ?? null,
            'full_name' => convert_case($this->full_name, MB_CASE_UPPER),
            'social_name' => convert_case($this->social_name, MB_CASE_UPPER),
            'document_number' => $this->document_number,
            'document_type_id' => $this->document_type_id,
            'state_document_id' => $this->state_document_id,
            'refreshPhoto' => $name == 'person_id',
        ];

        $this->emit('personModified', $array);
    }

    public function updatedDocumentTypeId()
    {
        if ($this->document_type_id != config('app.document_type_rg')) {
            $this->reset('document_number', 'state_document_id');
        } else {
            $this->state_document_id = config('app.state_rj');
            $this->select2SelectOption('state_document_id', $this->state_document_id);
            $this->reset('document_number');
        }
        $this->resetErrorBag();
    }

    public function updatedCountryId()
    {
//        $this->emit('hasMask', $this->detectIfCountryBrSelected());
    }

    public function updatedStateDocumentId()
    {
        $this->searchDocumentNumber();
    }

    public function searchDocumentNumber()
    {
        $document_type = $this->document_type_id;
        $document_number = convert_case(remove_punctuation($this->document_number), MB_CASE_UPPER);
        $document_state = $this->state_document_id;

        if (!is_null($this->document_number) && $this->document_number != '') {
            $document = app(Documents::class)->findByDocumentNumber(
                $document_type,
                $document_number,
                $document_state
            );

            if (!is_null($document)) {
                $this->person = $document->person;
                $this->person_id = $this->person->id;
                $this->contact = $this->person?->contacts?->first();
                if (!is_null($this->contact)) {
                    $this->emit('editContact', $this->contact, true);
                }
                $this->fillModel();
                $this->resetErrorBag();
                $this->document_number = convert_case(
                    remove_punctuation($document->number),
                    MB_CASE_UPPER
                );
                $this->document_type_id = $document->document_type_id;
                $this->state_document_id = $document->state_id;
                $this->setAddressReadOnly(true);
                $this->readonly = true;
                $this->updated('person_id', $this->person_id);
            } else {
                $this->person = new Person();
                $this->readonly = false;
                $this->updated('person', null);
            }
        }
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
            $this->person = Person::find($this->person_id);
            $this->readonly = true;
        } else {
            if (!$this->isPreFilled('document_number')) {
                //Fill CPF
                $document_number = is_null(old('document_number'))
                    ? (mask_cpf($this->person->cpf ?? request()->query('document_number'))) ?? ''
                    : mask_cpf(old('document_number'));

                $this->document_number = convert_case(
                    remove_punctuation($document_number),
                    MB_CASE_UPPER
                );
            }
        }

        if (!$this->isPreFilled('document_type_id')) {
            $this->document_type_id = is_null(old('document_type_id'))
                ? ($this->document_type_id ?? request()->query('document_type_id'))
                : old('document_type_id');
        }

        if ($this->document_type_id == config('app.document_type_cpf') && $this->document_number) {
            if ($document = Document::where('document_type_id', config('app.document_type_cpf'))->where('number', $this->document_number)->first()) {
                $this->person = $document->person;
                $this->readonly = true;
            }
        }

        $this->state_document_id = is_null(old('state_document_id'))
            ? $this->state_document_id
            : old('state_document_id');

        $this->person_id = is_null(old('person_id')) ? $this->person->id : old('person_id');
        $this->updated('person_id', $this->person_id);

        if (!$this->isPreFilled('full_name')) {
            $this->full_name = is_null(old('full_name'))
                ? (convert_case($this->person->full_name, MB_CASE_UPPER) ?? request()->query('full_name'))
                : old('full_name');
        }

        $this->social_name = is_null(old('social_name'))
            ? convert_case($this->person->social_name, MB_CASE_UPPER)
            : old('social_name');

        $this->fillAddress();

        if ($this->document_type_id == config('app.document_type_cpf') && $this->document_number) {
            $this->document_number = mask_cpf($this->document_number);
        }

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
        $this->applyMasks();
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
            $this->document_type_id = config('app.document_type_cpf');
        }

        if (!$this->readonly) {
            $this->loadDefaultLocation();
        }
    }

    /**
     * @return void
     */


    protected function isValidCpf()
    {
        if (!validate_cpf($this->document_number)) {
            $this->swallError('CPF inválido');
            return false;
        }
        return true;
    }
}
