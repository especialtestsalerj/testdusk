<?php

namespace App\Http\Livewire\People;

use App\Data\Repositories\Cities;
use App\Data\Repositories\Countries;
use App\Data\Repositories\Documents;
use App\Data\Repositories\People as PeopleRepository;
use App\Data\Repositories\PersonRestrictions as PersonRestrictionsRepository;
use App\Data\Repositories\States;
use App\Http\Livewire\BaseForm;
use App\Models\Person;

use Illuminate\Support\MessageBag;
use function app;
use function info;
use function view;

class People extends BaseForm
{
    public $person;

    public $person_id;
    public $cpf;
    public $full_name;
    public $origin;
    public $routineStatus;
    public $modal;
    public $readonly;
    public $showRestrictions = false;
    public $alerts = [];

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
        $document = app(Documents::class)->findByNumber(only_numbers($this->cpf));

        if(!is_null($document)){
            $this->person = $document->person;
            $this->fillModel();
            $this->readonly = true;

        }else{
            $this->openModal();
        }

    }

    public function fillModel()
    {
        $cpf = is_null(old('cpf')) ? mask_cpf($this->person->cpf) ?? '' : mask_cpf(old('cpf'));

        $this->cpf = $cpf;
        $this->person_id = is_null(old('person_id')) ? $this->person->id ?? '' : old('person_id');
        $this->full_name = is_null(old('full_name'))
            ? $this->person->full_name ?? ''
            : old('full_name');
        $this->origin = is_null(old('origin')) ? $this->person->origin ?? '' : old('origin');

        if ($this->showRestrictions) {
            $restrictions = app(PersonRestrictionsRepository::class)->getRestrictions(
                only_numbers($cpf)
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
        $this->fillModel();
    }

    public function render()
    {

        return view('livewire.people.partials.person')->with($this->getViewVariables());
    }

    protected function formVariables(){
        return [
            'countries'=>app(Countries::class)->allOrderBy('name','asc',null),
            'states'=>app(States::class)->allOrderBy('name','asc',null),
            'cities'=>app(Cities::class)->allOrderBy('name','asc',null),
        ];
    }

    public function openModal()
    {
        $this->dispatchBrowserEvent('openDocumentModalFOrm');
    }
}
