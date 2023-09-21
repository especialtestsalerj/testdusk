<?php

namespace App\Http\Livewire\PersonRestrictions;

use App\Http\Livewire\Traits\Swallable;
use App\Models\PersonRestriction;
use App\Models\Person;
use Livewire\Component;

class ModalForm extends Component
{
    use Swallable;

    protected $listeners = ['createRestriction', 'editRestriction'];

    public $person;
    public $restriction;
    public $started_at;
    public $ended_at;
    public $message;
    public $description;
    public $personRestriction;

    public $rules = [
        'started_at' => 'required:date',
        'message' => 'required',
        'description' => 'required',
    ];

    protected $messages = [
        'required' => ':attribute: preencha o campo corretamente.',
    ];

    protected $validationAttributes = [
        'started_at' => 'Início',
        'message' => 'Mensagem',
        'description' => 'Descrição',
    ];


    public function createRestriction(Person $person)
    {
        $this->person = $person;
    }

    public function editRestriction(PersonRestriction $personRestriction)
    {
        $this->restriction = $personRestriction;
        $this->message = $personRestriction->message;
        $this->description = $personRestriction->description;
        $this->started_at = $personRestriction->started_at->format('Y-m-d H:i');
        $this->ended_at = $personRestriction->ended_at?->format('Y-m-d H:i');
    }

    public function updatedEndedAt()
    {
        if (empty($this->ended_at)) {
            $this->ended_at = null;
        }
    }


    public function store()
    {
        $this->validate();

        if ($this->restriction) {
            $this->storeEditedRestriction();
        } else {
            $this->storeNewRestriction();
        }

        $this->swallSuccess('Restrição adicionada com sucesso');
        $this->cleanModal();

    }

    public function storeNewRestriction()
    {
        $this->person->restrictions()->create([
            'started_at' => $this->started_at,
            'ended_at' => $this->ended_at ?? null,
            'message' => $this->message,
            'description' => $this->description,
        ]);
    }

    public function storeEditedRestriction()
    {
        $this->restriction->update([
            'started_at' => $this->started_at,
            'ended_at' => $this->ended_at,
            'message' => $this->message,
            'description' => $this->description,
        ]);
    }

    public function render()
    {
        return view('livewire.person-restrictions.modal-form');
    }

    public function cleanModal()
    {
        $this->dispatchBrowserEvent('hide-modal', ['target' => 'restriction-modal']);
        $this->reset();
        $this->resetErrorBag();
    }
}
