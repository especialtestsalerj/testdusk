<?php

namespace App\Http\Livewire\People;

use App\Data\Repositories\Cities;
use App\Data\Repositories\Countries;
use App\Data\Repositories\Documents;
use App\Data\Repositories\DocumentTypes;
use App\Data\Repositories\People as PeopleRepository;
use App\Data\Repositories\PersonRestrictions as PersonRestrictionsRepository;
use App\Data\Repositories\States;
use App\Http\Livewire\BaseForm;
use App\Models\City;
use App\Models\Country;
use App\Models\DocumentType;
use App\Models\Person;

use App\Models\Visitor;
use Illuminate\Support\MessageBag;
use function app;
use function info;
use function view;

class People extends BaseForm
{
    public $person;

    public $person_id;
    public $document_number;
    public $full_name;
    public $social_name;
    public $country_id;
    public $state_id;
    public $city_id;
    public $other_city;
    public $document_type_id;


    public $cities =[];

    public $origin;
    public $routineStatus;
    public $modal;
    public $readonly;
    public $showRestrictions = false;
    public $alerts = [];

    public $visitor_id;

    public $visitor;



//    public function searchCpf()
//    {
//        try {
//            $this->resetErrorBag('cpf');
//            $this->alerts = [];
//
//            if (!validate_cpf(only_numbers($this->cpf))) {
//                $this->person_id = null;
//                $this->full_name = null;
//                $this->origin = null;
//
//                $this->addError('cpf', 'CPF não encontrado');
//            } elseif ($result = app(PeopleRepository::class)->findByCpf(only_numbers($this->cpf))) {
//                $this->person_id = $result['id'];
//                $this->full_name = $result['full_name'];
//                $this->origin = $result['origin'];
//
//                if ($this->showRestrictions) {
//                    $restrictions = app(PersonRestrictionsRepository::class)->getRestrictions(
//                        only_numbers($this->cpf)
//                    );
//
//                    foreach ($restrictions as $restriction) {
//                        array_push($this->alerts, $restriction->message);
//                    }
//                }
//            } else {
//                $this->person_id = null;
//                $this->full_name = null;
//                $this->origin = null;
//            }
//        } catch (\Exception $e) {
//            $this->focus('cpf');
//            info('Exception no CPF');
//        }
//    }

    public function searchDocumentNumber()
    {

        if(!is_null($this->document_number) && $this->document_number != "") {
            $document = app(Documents::class)->findByNumber(remove_punctuation($this->document_number));

            if (!is_null($document)) {
                $this->person = $document->person;
                $this->fillModel();
                $this->documentNumber = $document->number;
                $this->document_type_id = $document->document_type_id;
                $this->readonly = true;

            }else{
                $this->person = new Person();
                $this->readonly = false;
            }
        }

    }

    public function fillModel()
    {



        if(!empty($this->person_id)){
            $this->person = Person::where('id',$this->person_id)->first();
            $this->document_number = $document_number = $this->person->documents[0]->number;
            $this->readonly = true;
        }else{
            $document_number = is_null(old('document_number')) ? mask_cpf($this->person->cpf) ?? '' : mask_cpf(old('document_number'));


            $this->document_Number = $document_number;
        }


        $this->person_id = is_null(old('person_id')) ? $this->person->id ?? '' : old('person_id');
        $this->full_name = is_null(old('full_name'))
            ? $this->person->full_name ?? ''
            : old('full_name');

        $this->social_name = is_null(old('social_name'))
            ? $this->person->social_name ?? ''
            : old('social_name');

        $this->country_id = is_null(old('country_id'))
            ? $this->person->country_id ?? ''
            : old('country_id');

        $this->state_id = is_null(old('state_id'))
            ? $this->person->state_id ?? ''
            : old('state_id');



        $this->city_id = is_null(old('city_id'))
            ? $this->person->city_id ?? ''
            : old('city_id');

        if(!empty($this->city_id)) {
            $this->loadCities();
        }

        if(!empty($this->visitor)){

            $this->document_number = $this->visitor->document->number;
        }

        $this->other_city = is_null(old('other_city'))
            ? $this->person->other_city ?? ''
            : old('other_city');

        $this->origin = is_null(old('origin')) ? $this->person->origin ?? '' : old('origin');

        if ($this->showRestrictions) {
            $restrictions = app(PersonRestrictionsRepository::class)->getRestrictions(
                remove_punctuation($document_number)
            );

            foreach ($restrictions as $restriction) {
                array_push($this->alerts, $restriction->message);
            }
        }
    }

    public function mount()
    {

        if ($this->mode == 'create') {
            $this->person = new Person();
        }

        if(!empty($this->visitor_id)){
            $this->visitor = Visitor::where('id', $this->visitor_id)->first();
        }

//        dd($this->person_id);


        $this->fillModel();

        $this->loadDefault();


    }

    public function render()
    {

        return view('livewire.people.partials.person')->with($this->getViewVariables());
    }

    protected function formVariables(){
        return [
            'countries'=>app(Countries::class)->allOrderBy('name','asc',null),
            'states'=>app(States::class)->allOrderBy('name','asc',null),
            //'cities'=>app(Cities::class)->allOrderBy('name','asc',null),
            'documentTypes'=>app(DocumentTypes::class)->allOrderBy('name','asc',null),
            'country_br'=> Country::where('name','ilike', 'Brasil')->first(),
        ];
    }

    public function openModal()
    {
        $this->dispatchBrowserEvent('openDocumentModalFOrm');
    }

    private function loadDefault()
    {

        if(empty($this->document_type_id)) {
            $this->document_type_id = DocumentType::where('name', '=', 'CPF')->first()->id;
        }

//        dd($this->country_id);
        if(empty($this->country_id)) {
            $this->country_id = Country::where('name', 'ilike', 'Brasil')->first()->id;
        }
    }


    public function loadCities()
    {

        $this->cities =City::where('state_id',$this->state_id)->get();

    }
}
