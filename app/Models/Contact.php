<?php

namespace App\Models;

use App\Support\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = ['contact', 'status', 'person_id', 'contact_type_id'];

    public function people()
    {
        return $this->belongsTo(Person::class);
    }

    public function contactType()
    {
        return $this->belongsTo(ContactType::class);
    }

    public function getContactMaskeredAttribute()
    {
        $contactType = $this->contactType;
        if (!$contactType) {
            return $this->contact;
        }
        $contactTypeId = $contactType->id;

        if ($contactTypeId == Constants::CONTACT_TYPE_MOBILE) {
            return mask_mobile($this->contact);
        }

        if ($contactTypeId == Constants::CONTACT_TYPE_PHONE) {
            return mask_phone($this->contact);
        }
        return $this->contact;
    }
}

