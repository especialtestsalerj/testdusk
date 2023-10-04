<?php

namespace App\Listeners;

use App\Events\PersonRestrictionCreated;
use App\Events\PersonRestrictionDeleted;
use App\Events\PersonRestrictionsChanged;
use App\Events\VisitorCreated;
use App\Events\VisitorsChanged;

class OnPersonRestrictionDeleted extends Listener
{
    /**
     * Handle the event.
     *
     * @param  VisitorCreated  $event
     * @return void
     */
    public function handle(PersonRestrictionDeleted $event)
    {
        event(new PersonRestrictionsChanged($event->personRestrictionId));
    }
}
