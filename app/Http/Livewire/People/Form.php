<?php

namespace App\Http\Livewire\People;

use App\Data\Repositories\Countries as CountriesRepository;
use App\Data\Repositories\DisabilityTypes as DisabilityTypesRepository;
use App\Data\Repositories\Genders as GendersRepository;
use App\Data\Repositories\People as PeopleRepository;
use App\Data\Repositories\States as StatesRepository;
use App\Data\Repositories\Visitors as VisitorsRepository;
use App\Http\Livewire\BaseForm;
use App\Http\Livewire\Traits\Addressable;
use App\Models\City;
use App\Models\Country;
use App\Models\Document;
use App\Models\Person;
use App\Models\PersonRestriction;
use function view;

class Form extends BaseForm
{
    use Addressable;

    public Person $person;
    public $selectedId;

    public $person_id;
    public $full_name;
    public $social_name;
    public $birthdate;
    public $gender_id;
    public $has_disability;
    public $email;

    public $disabilities = [];

    public $edit;
    public $modalMode;

    public $people;
    public $disabled;
    public $readonly;
    public $redirect;

    public $showDisabilities = false;

    protected $rules = [
        'countryBr' => '',
        'country_id' => '',
        'city_id' => '',
        'state_id' => '',
    ];

    protected $listeners = [
        'confirm-delete-document' => 'deleteDocument',
        'confirm-delete-restriction' => 'deleteRestriction',
        'create-document' => '$refresh',
        'echo:person_restrictions,PersonRestrictionsChanged' => '$refresh',
    ];

    public $selectedDocument_id;

    public $selectedRestriction_id;

    public function find()
    {
        $result =
            $this->person_id == null
                ? false
                : app(PeopleRepository::class)->findById($this->person_id);

        if ($result) {
            $this->full_name = $result?->full_name;
            $this->social_name = $result?->social_name;
            $this->birthdate = $result?->birthdate;
            $this->gender_id = $result?->gender_id;
            $this->has_disability = $result?->has_disability;
            $this->city_id = $result?->city_id;
            $this->other_city = $result?->other_city;
            $this->state_id = $result?->state_id;
            $this->country_id = $result?->country_id;
            $this->email = $result?->email;
        } else {
            $this->clearFields();
        }
    }

    public function clearPerson()
    {
        $this->selectedId = null;

        $this->person_id = null;

        $this->clearFields();

        $this->readonly = false;

        $this->resetErrorBag();
    }

    public function clearFields()
    {
        $this->full_name = null;
        $this->social_name = null;
        $this->birthdate = null;
        $this->gender_id = null;
        $this->has_disability = null;
        $this->city_id = null;
        $this->other_city = null;
        $this->state_id = null;
        $this->country_id = null;
        $this->email = null;
    }

    public function fillModel($id)
    {
        $this->selectedId = $id;
        $this->person = Person::find($id);

        $this->person_id = is_null(old('id')) ? $this->person->id : old('id');

        $this->full_name = is_null(old('full_name'))
            ? convert_case($this->person->full_name, MB_CASE_UPPER)
            : old('full_name');

        $this->social_name = is_null(old('social_name'))
            ? convert_case($this->person->social_name, MB_CASE_UPPER)
            : old('social_name');

        $this->birthdate = is_null(old('birthdate')) ? $this?->person->birthdate : old('birthdate');

        $this->gender_id = is_null(old('gender_id')) ? $this->person->gender_id : old('gender_id');

        $this->has_disability = is_null(old('has_disability'))
            ? $this->person->has_disability
            : old('has_disability');

        $this->disabilities = $this->person->disabilities->pluck('id')->toArray();

        $this->fillAddress();

        $this->email = is_null(old('email'))
            ? convert_case($this?->person?->email, MB_CASE_LOWER)
            : old('email');
    }

    public function loadCities()
    {
        $city_id = empty($this->city_id) ? null : $this->city_id;
        $state_id = empty($this->state_id) ? null : $this->state_id;

        if (isset($this->state_id)) {
            $this->cities = City::where('state_id', $state_id)
                ->where(function ($query) use ($city_id) {
                    $query
                        ->when(isset($id), function ($query) use ($city_id) {
                            $query->orWhere('id', '=', $city_id);
                        })
                        ->orWhere('status', true);
                })
                ->orderBy('name')
                ->get();
        }
    }

    protected function getComponentVariables()
    {
        $disabilityIds = $this->person->disabilities->pluck('id')->toArray();

        return [
            'genders' => app(GendersRepository::class)->allActive($this->gender_id),
            'disabilityTypes' => app(DisabilityTypesRepository::class)->allActive($disabilityIds),
            'countries' => app(CountriesRepository::class)->allActive($this->country_id),
            'states' => app(StatesRepository::class)->allActive($this->state_id),
            'country_br' => Country::where('id', '=', config('app.country_br'))->first(),
        ];
    }

    public function mount($id)
    {
        $this->fillModel($id);
    }

    public function render()
    {
        $this->loadCountryBr();

        return view('livewire.people.form')->with($this->getViewVariables());
    }

    public function prepareForDeleteDocument($document_id)
    {
        $this->selectedDocument_id = $document_id;
        $document = Document::find($document_id);
        if (empty(app(VisitorsRepository::class)->findBydocumentId($document_id))) {
            $this->emitSwall(
                'Deseja realmente remover o ' .
                    $document->documentType->name .
                    ': ' .
                    $document->numberMaskered .
                    '?',
                'A ação não poderá ser desfeita.',
                'confirm-delete-document',
                'delete'
            );
        } else {
            $this->dispatchBrowserEvent('swall-error', [
                'text' => $document->documentType->name . ' utilizado em Visita',
            ]);
        }
    }

    public function prepareForDeleteRestriction($restriction_id)
    {
        $this->selectedRestriction_id = $restriction_id;
        $restriction = PersonRestriction::find($restriction_id);
        $this->emitSwall(
            'Deseja realmente remover a restrição ' . ': ' . $restriction->message . '?',
            'A ação não poderá ser desfeita.',
            'confirm-delete-restriction',
            'delete'
        );
    }

    public function editDocument($document)
    {
        $this->emit('editDocument', $document);
    }

    public function createDocument($person)
    {
        $this->emit('createDocument', $person);
    }

    public function createRestriction($person)
    {
        $this->emit('createRestriction', $person);
    }

    public function detailRestriction($personRestriction)
    {
        $this->emit('detailRestriction', $personRestriction);
    }

    public function editRestriction($personRestriction)
    {
        $this->emit('editRestriction', $personRestriction);
    }

    public function deleteDocument()
    {
        $document = Document::find($this->selectedDocument_id);
        $person_id = $document->person->id;

        $document->delete();
        $this->fillModel($person_id);
    }
    public function deleteRestriction()
    {
        $restriction = PersonRestriction::find($this->selectedRestriction_id);
        $restriction->delete();
        $this->emit('deleteRestriction');
    }
}
