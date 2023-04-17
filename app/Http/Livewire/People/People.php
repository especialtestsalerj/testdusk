<?php

namespace App\Http\Livewire\People;

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
    public $cpf;
    public $full_name;
    public $origin;
    public $routineStatus;
    public $modal;
    public $readonly;

    public function searchCpf()
    {
        try {
            $this->resetErrorBag('cpf');
            if (!validate_cpf(only_numbers($this->cpf))) {
                $this->person_id = null;
                $this->full_name = null;
                $this->origin = null;

                $this->addError('cpf', 'CPF não encontrado');
            } elseif ($result = app(PeopleRepository::class)->findByCpf(only_numbers($this->cpf))) {
                $this->person_id = $result['id'];
                $this->full_name = $result['full_name'];
                $this->origin = $result['origin'];

                $this->resetErrorBag('cpf');
            } else {
                $this->person_id = null;
                $this->full_name = null;
                $this->origin = null;
            }
        } catch (\Exception $e) {
            $this->focus('cpf');
            info('Exception no CPF');
        }
    }

    public function fillModel()
    {
        $this->cpf = is_null(old('cpf'))
            ? mask_cpf($this->person->cpf) ?? ''
            : mask_cpf(old('cpf'));
        $this->person_id = is_null(old('person_id')) ? $this->person->id ?? '' : old('person_id');
        $this->full_name = is_null(old('full_name'))
            ? $this->person->full_name ?? ''
            : old('full_name');
        $this->origin = is_null(old('origin')) ? $this->person->origin ?? '' : old('origin');
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
        return view('livewire.people.partials.person');
    }
}
