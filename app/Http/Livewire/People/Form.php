<?php

namespace App\Http\Livewire\People;

use App\Data\Repositories\Countries;
use App\Data\Repositories\DisabilityTypes;
use App\Data\Repositories\Genders;
use App\Data\Repositories\People as PeopleRepository;
use App\Data\Repositories\States;
use App\Data\Repositories\Visitors;
use App\Http\Livewire\BaseForm;
use App\Models\City;
use App\Models\Country;
use App\Models\Document;
use App\Models\Person;
use App\Data\Repositories\Genders as GendersRepository;
use App\Data\Repositories\DisabilityTypes as DisabilityTypesRepository;

use function view;

class Form extends BaseForm
{
    public Person $person;
    public $selectedId;

    public $person_id;
    public $full_name;
    public $social_name;
    public $birthdate;
    public $gender_id;
    public $has_disability;
    public $city_id;
    public $other_city;
    public $state_id;
    public $country_id;
    public $email;

    public $disabilities = [];

    public $cities = [];

    public $edit;
    public $modalMode;

    public $people;
    public $disabled;
    public $readonly;
    public $redirect;

    public $showDisabilities = false;

    protected $listeners = [
        'confirm-delete-document' => 'deleteDocument',
    ];
    public $selectedDocument_id;

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
    /*
    public function prepareForUpdate($id, $readonly = false)
    {
        $this->selectedId = $id;
        $person = Person::find($id);

        $this->modalMode = $readonly ? 'detail' : 'update';
        $this->readonly = $readonly;

        $this->person_id = $id;
        $this->full_name = mb_strtoupper($person?->full_name);
        $this->social_name = mb_strtoupper($person?->social_name);
        $this->birthdate = $person?->birthdate?->format('Y-m-d');
        $this->gender_id = $person?->gender_id;
        $this->has_disability = $person?->has_disability;
        $this->city_id = $person?->city_id;
        $this->other_city = mb_strtoupper($person?->other_city);
        $this->state_id = $person?->state_id;
        $this->country_id = $person?->country_id;
        $this->email = mb_strtolower($person?->email);

        $this->dispatchBrowserEvent('show-modal', ['target' => 'person-modal']);
    }*/

    public function store()
    {
        $this->validate(
            [
                'full_name' => ['required'],
                'social_name' => ['nullable', 'bail', 'string|min:3|max:255'],
            ],
            [
                'full_name.required' => 'Nome Completo: preencha o campo corretamente.',
                'social_name.min' => 'Nome Social: deve ter pelo menos 3 caracteres.',
            ]
        );

        $values = ['redirect' => $this->redirect];
        $values = array_merge($values, ['id' => $this->person_id]);
        $values = array_merge($values, ['full_name' => $this->full_name]);
        $values = array_merge($values, ['social_name' => $this->social_name]);
        $values = array_merge($values, [
            'birthdate' => $this?->birthdate == '' ? null : $this?->birthdate,
        ]);
        $values = array_merge($values, ['gender_id' => $this->gender_id]);
        $values = array_merge($values, ['has_disability' => $this->has_disability]);
        $values = array_merge($values, ['city_id' => $this->city_id]);
        $values = array_merge($values, ['other_city' => $this->other_city]);
        $values = array_merge($values, ['state_id' => $this->state_id]);
        $values = array_merge($values, ['country_id' => $this->country_id]);
        $values = array_merge($values, ['email' => $this->email]);

        if ($this->selectedId) {
            $row = Person::find($this->selectedId);
            $row->fill($values);
            $row->save();
        } else {
            Person::create($values);
        }

        //trocar validacao acima para usar direto do request
        //trocar isso por submit

        $this->clearPerson();
        $this->dispatchBrowserEvent('hide-modal', ['target' => 'person-modal']);
    }

    public function fillModel($id)
    {
        $this->selectedId = $id;
        $this->person = Person::find($id);

        $this->person_id = is_null(old('id')) ? $this->person->id ?? '' : old('id');
        //dd($this->person_id);
        $this->full_name = is_null(old('full_name'))
            ? $this->person->full_name ?? ''
            : old('full_name');

        $this->social_name = is_null(old('social_name'))
            ? $this->person->social_name ?? ''
            : old('social_name');

        $this->birthdate = is_null(old('birthdate')) ? $this?->person->birthdate : old('birthdate');

        $this->gender_id = is_null(old('gender_id'))
            ? $this->person->gender_id ?? ''
            : old('gender_id');

        $this->has_disability = is_null(old('has_disability'))
            ? $this->person->has_disability ?? ''
            : old('has_disability');

        $this->disabilities =  $this->person->disabilities->pluck('id')->toArray();

        $this->city_id = is_null(old('city_id')) ? $this->person->city_id ?? '' : old('city_id');

        if (!empty($this->city_id)) {
            $this->loadCities();
        }

        $this->other_city = is_null(old('other_city'))
            ? $this->person->other_city ?? ''
            : old('other_city');

        $this->state_id = is_null(old('state_id'))
            ? $this->person->state_id ?? ''
            : old('state_id');

        $this->country_id = is_null(old('country_id'))
            ? $this->person->country_id ?? ''
            : old('country_id');

        $this->email = is_null(old('email')) ? $this->person->email ?? '' : old('email');
    }

    public function loadCities()
    {
        $this->cities = City::where('state_id', $this->state_id)->get();
    }

    protected function getComponentVariables()
    {
        return [
            'genders' => app(Genders::class)->allOrderBy('id', 'asc', null),
            'disabilityTypes' => app(DisabilityTypes::class)->allOrderBy('name', 'asc', null),
            'countries' => app(Countries::class)->allOrderBy('name', 'asc', null),
            'states' => app(States::class)->allOrderBy('name', 'asc', null),
            'country_br' => Country::where(
                'id',
                '=',
                mb_strtoupper(env('APP_COUNTRY_BR'))
            )->first(),
        ];
    }

    public function mount($id)
    {


        $this->fillModel($id);
    }

    public function render()
    {
        return view('livewire.people.form')->with($this->getViewVariables());
    }


    public function prepareForDeleteDocument($document_id)
    {
        $this->selectedDocument_id = $document_id;
        $document = Document::find($document_id);
        if(empty(app(Visitors::class)->findBydocumentId($document_id))) {


            $this->emitSwall(
                'Deseja realmente remover o ' . $document->documentType->name .
                ': ' . $document->numberMaskered,
                'A ação não pode ser desfeita',
                'confirm-delete-document',
                'delete'
            );
        }else{
            $this->dispatchBrowserEvent('swal-checkout-failure', [
                'error' => $document->documentType->name .' utilizado em Visita',]);
        }
    }

    public function deleteDocument()
    {
        $document = Document::find($this->selectedDocument_id);
        $person_id = $document->person->id;

        $document->delete();
        $this->fillModel($person_id);

    }
}
