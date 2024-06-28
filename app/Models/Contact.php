<?php

namespace App\Models;

use App\Support\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = ['contact', 'status', 'person_id', 'contact_type_id'];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function contactType()
    {
        return $this->belongsTo(ContactType::class);
    }

    public function getContactMaskedAttribute()
    {
        $person = $this->person;

        $contactType = $this->contactType;

        if (!$person || !$person->isBrazilian() || !$contactType) {
            return $this->contact;
        }

        switch ($contactType->id) {
            case Constants::CONTACT_TYPE_MOBILE:
                return mask_mobile($this->contact);
            case Constants::CONTACT_TYPE_PHONE:
                return mask_phone($this->contact);
            default:
                return $this->contact;
        }
    }
}

