<?php

namespace App\Http\Livewire\Visitors;

use App\Data\Repositories\People as PeopleRepository;
use App\Http\Livewire\BaseForm;
use App\Models\Person;
use function app;
use function info;
use function view;

class People extends BaseForm
{
    public $person;

    public $person_id;
    public $certificate_type;
    public $id_card;
    public $certificate_number;
    public $certificate_valid_until;

    public function find()
    {
        try {
            //$this->resetErrorBag('certificate_type');

            if ($result = app(PeopleRepository::class)->findById($this->person_id)) {
                $this->person_id = $result['id'];
                $this->certificate_type = $result['certificate_type'];
                $this->id_card = $result['id_card'];
                $this->certificate_number = $result['certificate_number'];
                $this->certificate_valid_until = $result['certificate_valid_until'];

                $this->resetErrorBag('cpf');
            } else {
                $this->certificate_type = null;
                $this->id_card = null;
                $this->certificate_number = null;
                $this->certificate_valid_until = null;
            }
        } catch (\Exception $e) {
            //$this->focus('cpf');
            //info('Exception no CPF');
        }
    }

    public function fillModel()
    {
        $this->person_id = is_null(old('person_id')) ? $this->person->id ?? '' : old('person_id');
        $this->certificate_type = is_null(old('certificate_type'))
            ? $this->person->certificate_type ?? ''
            : old('certificate_type');
        $this->id_card = is_null(old('id_card')) ? $this->person->id_card ?? '' : old('id_card');
        $this->certificate_number = is_null(old('certificate_number'))
            ? $this->person->certificate_number ?? ''
            : old('certificate_number');
        $this->certificate_valid_until = is_null(old('certificate_valid_until'))
            ? $this->person->certificate_valid_until ?? ''
            : old('certificate_valid_until');
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
        return view('livewire.visitors.partials.person');
    }
}
