<?php

namespace App\Events;

use App\Models\CongressmanLegislature;

class VisitorDeleted extends Event
{
    public $visitorId;

    /**
     * Create a new visitor instance.
     *
     * @param $visitor
     */
    public function __construct($visitor)
    {
        $this->visitorId = $visitor->id;
    }
}
