<?php

namespace App\Listeners;

use App\Events\VisitorDeleted;
use App\Events\VisitorsChanged;

class OnVisitorDeleted extends Listener
{
    /**
     * Handle the event.
     *
     * @param  VisitorDeleted  $event
     * @return void
     */
    public function handle(VisitorDeleted $event)
    {
        event(new VisitorsChanged($event->visitorId));
    }
}
