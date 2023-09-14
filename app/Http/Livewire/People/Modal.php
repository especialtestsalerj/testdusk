<?php

namespace App\Http\Livewire\People;

use App\Data\Repositories\People as PeopleRepository;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Person;


class Modal extends People
{
    protected $rules = [
        'state_document_id' => 'required_if:document_type_id,2',
        'document_type_id' => 'required',
        'full_name' =>  'required',
        'country_id' => 'required',
        'state_id' => 'required',
        'city_id' => 'required',
        'document_number' => 'required',
        'other_city' => 'required_if:city_id,1',
    ];

    protected $validationAttributes = [
        'document_type_id' => 'Tipo de Documento',
        'document_number' => 'Número',
        'state_id' => 'Estado',
        'city_id' => 'Cidade',
        'full_name' => 'Nome Completo',
        'other_city' => 'Cidade',
        'state_document_id' => 'UF do Documento',
    ];


    public function render()
    {
        $this->loadCountryBr();
        return view('livewire.people.partials.modal')->with($this->getViewVariables());
    }


    public function save()
    {
        $this->isValidCpf();
        $this->validate();
        $this->createPerson();
        $this->swallSuccess('Pessoa adicionada com sucesso');
    }

    public function createPerson()
    {
        $request = [
            'state_document_id' => $this->state_document_id,
            'document_type_id' => $this->document_type_id,
            'full_name' =>  $this->full_name,
            'social_name' => $this->social_name,
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'other_city' => $this->other_city,
        ];

        $person = Person::create($request);

        $this->person_id = $person->id;

        Document::firstOrCreate([
            'person_id' => $this->person_id,
            'number' => convert_case(
                remove_punctuation($this->document_number),
                MB_CASE_UPPER
            ),
            'document_type_id' => $this->document_type_id,
            'state_id' => $this->state_document_id,
        ]);

        $this->resetModal();

    }

    public function resetModal()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('hide-modal', ['target' => 'peopleModal']);

        $this->select2SetReadOnly('city_id', false);
        $this->select2SetReadOnly('state_id', false);
        $this->select2SetReadOnly('country_id', false);

        $this->loadDefault();
    }

    private function isValidCpf()
    {
        if ($this->document_type_id == DocumentType::class::where('name','CPF')->first()->id && !validate_cpf($this->document_number)) {
            $this->swallError('CPF inválido');
            return false;
        }
        return true;
    }


}
