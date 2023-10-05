<?php

namespace App\Listeners;

use App\Events\PersonRestrictionCreated;
use App\Events\PersonRestrictionsChanged;
use App\Events\VisitorCreated;
use App\Events\VisitorsChanged;

class OnPersonRestrictionCreated extends Listener
{
    /**
     * Handle the event.
     *
     * @param  VisitorCreated  $event
     * @return void
     */
    public function handle(PersonRestrictionCreated $event)
    {
        event(new PersonRestrictionsChanged($event->personRestrictionId));
    }
}
