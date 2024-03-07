<?php

namespace App\Http\Livewire\Contacts;

use App\Data\Repositories\Contacts;
use App\Http\Livewire\BaseForm;
use App\Http\Livewire\Traits\Maskable;
use App\Models\Contact;
use App\Models\ContactType;

class Form extends BaseForm
{
    use Maskable;

    public $contacts;
    public $contact;
    public $person_id;
    public $contact_type_id;
    public $status = true;
    public $modal;
    public $readonly;
    public $isVisitorsForm = false;
    public $contact_id;

    protected $listeners = [
        'editContact',
        'cleanVariables',
    ];

    public function mount()
    {
        if ($this->contacts && !$this->isVisitorsForm) {
            $contact = $this->contacts;
        } elseif ($this->isVisitorsForm) {
            $contact = app(Contacts::class)->getActiveContactByPerson($this->person_id);
        }

        if (isset($contact)) {
            $this->contact_type_id = $contact->contact_type_id;
            $this->contact = $contact->contact;
        }
    }

    public function updatedContactTypeId()
    {
        $this->reset('contact');
    }

    public function cleanVariables()
    {
        $this->resetExcept('person_id');
    }

    public function editContact(Contact $contact)
    {
        $this->contact_id = $contact->id;
        $this->fill($contact);
    }

    public function updated($name, $value)
    {
        $array = [
            'id' => $this->contact_id ?? null,
            'contact' => $this->contact,
            'contact_type_id' => $this->contact_type_id,
            'status' => $this->status,
            'person_id' => $this->person_id,
        ];

        $this->emit('contactModified', $array);
    }

    public function formVariables()
    {
        return [
            'contactTypes' => ContactType::class::where('status', true)->get(),
        ];
    }

    public function render()
    {
        $this->applyMasks();
        return view('livewire.contacts.form')->with($this->getViewVariables());
    }

}
