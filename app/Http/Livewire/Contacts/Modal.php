<?php

namespace App\Http\Livewire\Contacts;

use App\Http\Livewire\BaseForm;
use App\Http\Livewire\Traits\Maskable;
use App\Models\Contact;
use App\Support\Constants;


class Modal extends BaseForm
{
    use Maskable;

    public $person_id;
    public $contact_type_id;
    public $status = true;
    public $contact;
    public $contact_id;

    protected $listeners = [
        'createContact',
        'contactModified'
    ];

    public function rules()
    {
        $rules = ['contact' => 'required', 'contact_type_id' => 'required'];

        if ($this->contact_type_id == Constants::CONTACT_TYPE_EMAIL) {
            $rules['contact'] = 'required|email';
        }

        return $rules;
    }

    protected $validationAttributes = [
        'contact' => 'Contato',
        'contact_type_id' => 'Tipo de Contato',
    ];

    public function contactModified($contact)
    {
        $this->fill([
            'contact_id' => $contact['id'],
            'contact_type_id' => $contact['contact_type_id'],
            'status' => $contact['status'],
            'contact' => $contact['contact'],
        ]);
    }

    public function cleanModal()
    {
        $this->emit('cleanVariables');
        $this->resetExcept('person_id');
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.contacts.partials.modal');
    }

    public function storeContact()
    {
        $this->validate();
        $this->updateOrCreateContact();
        $this->dispatchBrowserEvent('hide-modal', ['target' => 'contact-modal']);
        $this->cleanModal();
        $this->emit('store-contact');
        $this->swallSuccess('Salvo com sucesso');
    }

    public function updateOrCreateContact()
    {
        $contact = $this->contact_type_id != Constants::CONTACT_TYPE_EMAIL ? remove_punctuation($this->contact) : $this->contact;

        if ($this->contact_id === null) {
            Contact::updateOrCreate(
                [
                    'person_id' => $this->person_id,
                    'contact' => $contact,
                    'contact_type_id' => $this->contact_type_id,
                ],
                [
                    'status' => $this->status,
                ]
            );
        } else {
            Contact::where('id', $this->contact_id)->update([
                'contact_type_id' => $this->contact_type_id,
                'person_id' => $this->person_id,
                'status' => $this->status,
                'contact' => $contact,
            ]);
        }
    }
}
