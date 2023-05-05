<?php

namespace App\Http\Livewire\Visitors;

use App\Data\Repositories\Visitors as VisitorsRepository;
use App\Http\Livewire\BaseForm;
use App\Models\Person;
use function app;
use function info;
use function view;

class People extends BaseForm
{
    public $routine_id;
    public $visitor_id;
    public $caution_id;

    public $visitors;

    public $person_id;
    public $certificate_type;
    public $id_card;
    public $certificate_number;
    public $certificate_valid_until;
    public $destiny_sector_name;

    public $routineStatus;
    public $readonly;

    public function find()
    {
        $result =
            $this->visitor_id == null
                ? false
                : app(VisitorsRepository::class)->findById($this->visitor_id);

        if ($result) {
            $this->person_id = $result->person->id;
            $this->certificate_type = $result->person->certificate_type;
            $this->id_card = $result->person->id_card;
            $this->certificate_number = $result->person->certificate_number;
            $this->certificate_valid_until = $result->person->certificate_valid_until;
            $this->destiny_sector_name = $result?->sector?->name;
            if ($result->hasCpfActiveOnRoutine($this->caution_id)) {
                $this->addError('msg_visitor', 'Visitante possui cautela em aberto.');
            }
        } else {
            $this->person_id = null;
            $this->certificate_type = null;
            $this->id_card = null;
            $this->certificate_number = null;
            $this->certificate_valid_until = null;
            $this->destiny_sector_name = null;
        }
    }

    public function fillModel()
    {
        $this->visitors = app(VisitorsRepository::class)->findByRoutineWithoutPending(
            $this->routine_id
        );

        $this->visitor_id = old('visitor_id') ?? $this->visitor_id;

        $visitor = app(VisitorsRepository::class)->findById($this->visitor_id);

        $this->certificate_type = is_null(old('certificate_type'))
            ? $visitor->person->certificate_type ?? ''
            : old('certificate_type');
        $this->id_card = is_null(old('id_card')) ? $visitor->person->id_card ?? '' : old('id_card');
        $this->certificate_number = is_null(old('certificate_number'))
            ? $visitor->person->certificate_number ?? ''
            : old('certificate_number');
        $this->certificate_valid_until = is_null(old('certificate_valid_until'))
            ? $visitor->person->certificate_valid_until ?? ''
            : old('certificate_valid_until');
        $this->destiny_sector_name = is_null(old('destiny_sector_name'))
            ? $visitor->sector->name ?? ''
            : old('destiny_sector_name');
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
