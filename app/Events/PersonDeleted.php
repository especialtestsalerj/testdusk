<?php

namespace App\Events;

class PersonDeleted extends Event
{
    public $personId;

    /**
     * Create a new person instance.
     *
     * @param $person
     */
    public function __construct($person)
    {
        $this->personId = $person->id;
    }
}
