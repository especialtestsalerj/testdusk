<?php

namespace App\Http\Livewire\Contacts;

use App\Data\Repositories\Contacts;
use App\Http\Livewire\BaseForm;
use App\Http\Livewire\Traits\Maskable;
use App\Models\Contact;
use App\Models\ContactType;
use App\Models\Person;
use App\Support\Constants;

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
    public $isRequired = false;
    public $contact_id;
    public $hasMask;

    protected $listeners = [
        'editContact',
        'cleanVariables',
        'hasCard',
        'hasMask',
    ];

    public function mount()
    {
        if ($this->person_id) {
            $this->hasMask = Person::find($this->person_id)->isBrazilian();
        }
        if ($this->contacts && !$this->isVisitorsForm) {
            $contact = $this->contacts;
        } elseif ($this->isVisitorsForm) {
            $contact = app(Contacts::class)->getActiveContactByPerson($this->person_id);
            if ($oldValue = old('contact_type_id')) {
                $this->contact_type_id = $oldValue;
            }
            if ($oldValue = old('contact')) {
                $this->contact = $oldValue;
            }
        }

        if (isset($contact)) {
            $this->contact_type_id = $contact->contact_type_id ?? $this->contact_type_id;
            $this->contact = $this->hasMask ? $this->applyMask($contact) : $contact->contact;
        }
    }

    public function applyMask($contact)
    {
        switch ($this->contact_type_id) {
            case Constants::CONTACT_TYPE_MOBILE:
                return mask_mobile($contact->contact);
            case Constants::CONTACT_TYPE_PHONE:
                return mask_phone($contact->contact);
            default:
                return $contact->contact;
        }
    }

    public function updatedContactTypeId()
    {
        $this->reset('contact');
    }

    public function hasCard($cardId)
    {
        $this->isRequired = (bool)$cardId;
    }

    public function cleanVariables()
    {
        $this->resetExcept('person_id', 'isRequired', 'hasMask');
    }

    public function editContact(Contact $contact, $readonly = false)
    {
        $this->readonly = $readonly;
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
        if ($this->hasMask) {
            $this->applyMasks();
        }
        return view('livewire.contacts.form')->with($this->getViewVariables());
    }

    public function hasMask($value)
    {
        $this->hasMask = $value;
    }

}
