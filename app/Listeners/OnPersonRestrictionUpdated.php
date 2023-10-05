<?php

namespace App\Listeners;

use App\Events\PersonRestrictionCreated;
use App\Events\PersonRestrictionsChanged;
use App\Events\PersonRestrictionUpdated;
use App\Events\VisitorCreated;
use App\Events\VisitorsChanged;

class OnPersonRestrictionUpdated extends Listener
{
    /**
     * Handle the event.
     *
     * @param  VisitorCreated  $event
     * @return void
     */
    public function handle(PersonRestrictionUpdated $event)
    {
        event(new PersonRestrictionsChanged($event->personRestrictionId));
    }
}
