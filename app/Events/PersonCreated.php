<?php

namespace App\Events;

class PersonCreated extends Event
{
    public $personId;

    public function __construct($person)
    {
        $this->personId = $person->id;
    }
}
