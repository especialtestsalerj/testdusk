<?php

namespace App\Data\Repositories;

use App\Models\Contact;
use App\Support\Constants;

class Contacts extends Repository
{
    /**
     * @var string
     */
    protected $model = Contact::class;

    public function findByPerson($person_id)
    {
        return $this->model::where('person_id', $person_id)->get();
    }

    public function firstOrCreateContact($request)
    {
        if ($request->get('contact_type_id') != Constants::CONTACT_TYPE_EMAIL) {
            $contactNumber = remove_punctuation($request->get('contact'));
        } else {
            $contactNumber = $request->get('contact');
        }

        $contact = Contact::updateOrCreate(
            [
                'person_id' => $request->get('person_id'),
                'contact' => $contactNumber,
                'contact_type_id' => $request->get('contact_type_id'),
            ],
            [
                'status' => true,
            ]
        );
    }

    public function getActiveContactByPerson($person_id)
    {
        return $this->model::where('person_id', $person_id)
            ->orderByDesc('updated_at')
            ->where('status', true)
            ->first();
    }
}
