<?php

namespace App\Listeners;

use App\Events\VisitorsChanged;
use App\Events\VisitorUpdated;

class OnVisitorUpdated extends Listener
{
    /**
     * Handle the event.
     *
     * @param  VisitorUpdated  $event
     * @return void
     */
    public function handle(VisitorUpdated $event)
    {
        event(new VisitorsChanged($event->visitorId));
    }
}
