<?php

namespace App\Events;

use App\Models\Visitor;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Events\Traits\RateLimited;

class VisitorsChanged extends Broadcastable
{
    use Dispatchable, InteractsWithSockets, SerializesModels, RateLimited;

    public $visitorId;
    public $personId;

    /**
     * Create a new congressmanBudget instance.
     *
     * @param $congressmanId
     */
    public function __construct($visitorId)
    {
        $visitor = Visitor::find($visitorId);
        $this->visitorId = $visitor->id;

        $this->personId = $visitor->person_id;
    }

    public function broadcastChannelName()
    {
        return 'visitors';
    }
}
