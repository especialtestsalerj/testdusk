<?php

namespace App\Events;

class PersonRestrictionCreated extends Event
{
    public $personRestrictionId;

    public function __construct($personRestriction)
    {
        $this->personRestrictionId = $personRestriction->id;
    }
}
