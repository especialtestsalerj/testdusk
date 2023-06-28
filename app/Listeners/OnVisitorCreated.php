<?php

namespace App\Listeners;

use App\Events\VisitorCreated;
use App\Events\VisitorsChanged;

class OnVisitorCreated extends Listener
{
    /**
     * Handle the event.
     *
     * @param  VisitorCreated  $event
     * @return void
     */
    public function handle(VisitorCreated $event)
    {
        event(new VisitorsChanged($event->visitorId));
    }
}
