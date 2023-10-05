<?php

namespace App\Events;

use App\Models\Visitor;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Events\Traits\RateLimited;
use Illuminate\Broadcasting\Channel;

class PersonRestrictionsChanged extends Broadcastable
{
    use Dispatchable, InteractsWithSockets, SerializesModels, RateLimited;
    public $personRestricionId;

    /**
     * Create a new congressmanBudget instance.
     *
     * @param $congressmanId
     */
    public function __construct($personRestricionId)
    {
        $this->personRestricionId = $personRestricionId;
    }
    public function broadcastChannelName()
    {
        return new Channel('person_restrictions');
    }
}
