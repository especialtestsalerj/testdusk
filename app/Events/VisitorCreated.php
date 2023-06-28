<?php

namespace App\Events;

class VisitorCreated extends Event
{
    public $visitorId;

    /**
     * Create a new visitor budget instance.
     *
     * @param $visitor
     */
    public function __construct($visitor)
    {
        $this->visitorId = $visitor->id;
    }
}
