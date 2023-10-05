<?php

namespace App\Events;

class PersonRestrictionDeleted extends Event
{
    public $personRestrictionId;

    /**
     * Create a new person instance.
     *
     * @param $person
     */
    public function __construct($personRestriction)
    {
        $this->personRestrictionId = $personRestriction->id;
    }
}
