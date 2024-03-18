<?php

namespace App\Http\Livewire\Contacts;

use App\Data\Repositories\Contacts;
use App\Http\Livewire\BaseForm;
use App\Models\Contact;
use App\Models\Person;
use App\Support\Constants;

class Index extends BaseForm
{
    public Person $person;
    public Contact $selectedContact;

    protected $listeners = [
        'confirm-delete-contact' => 'deleteContact',
        'store-contact' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.contacts.index')->with($this->getViewVariables());
    }

    public function formVariables()
    {
        return [
            'contacts' => app(Contacts::class)->findByPerson($this->person->id),
        ];
    }

    public function editContact(Contact $contact)
    {
        $this->emit('contactModified', $contact);
        $this->emit('editContact', $contact);
    }

    public function prepareForDeleteContact(Contact $contact)
    {
        $this->selectedContact = $contact;

        $this->emitSwall(
            'Deseja realmente remover o ' .
            $contact->contactType->name .
            ': ' .
            $contact->getContactMaskeredAttribute() .
            '?',
            'A ação não poderá ser desfeita.',
            'confirm-delete-contact',
            'delete'
        );
    }

    public function deleteContact()
    {
        $this->selectedContact->delete();
        $this->emit('$refresh');
    }
}
