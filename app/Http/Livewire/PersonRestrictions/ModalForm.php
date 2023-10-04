<?php

namespace App\Http\Livewire\PersonRestrictions;

use App\Http\Livewire\Traits\Swallable;
use App\Models\PersonRestriction;
use App\Models\Person;
use Livewire\Component;

class ModalForm extends Component
{
    use Swallable;

    protected $listeners = [
        'createRestriction',
        'editRestriction',
        'detailRestriction',
        'deleteRestriction',
    ];

    public $person;
    public $restriction;
    public $started_at;
    public $ended_at;
    public $message;
    public $description;
    public $personRestriction;
    public $modalMode;
    public $readonly = false;

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
        $this->modalMode = 'create';
        $this->person = $person;
        $this->started_at = date('Y-m-d H:i');
    }

    public function detailRestriction(PersonRestriction $personRestriction)
    {
        $this->editRestriction($personRestriction);
        $this->modalMode = 'detail';
        $this->readonly = true;
    }

    public function editRestriction(PersonRestriction $personRestriction)
    {
        $this->modalMode = 'update';
        $this->restriction = $personRestriction;
        $this->message = $personRestriction->message;
        $this->description = $personRestriction->description;
        $this->started_at = $personRestriction->started_at->format('Y-m-d H:i');
        $this->ended_at = $personRestriction->ended_at?->format('Y-m-d H:i');
    }

    public function deleteRestriction(PersonRestriction $personRestriction)
    {
        $this->cleanModal();
        //return redirect()->to('/people/' . $this->restriction->person_id . '/show');
//        return redirect()->to('/people/15/show');
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
            $this->swallSuccess('Restrição alterada com sucesso');
        } else {
            $this->storeNewRestriction();
            $this->swallSuccess('Restrição adicionada com sucesso');
        }

        $this->cleanModal();
//        return redirect()->to('/people/' . $this->restriction->person_id . '/show');
       // return redirect()->to('/people/15/show');
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
