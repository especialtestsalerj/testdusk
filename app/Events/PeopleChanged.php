<?php

namespace App\Events;

use App\Models\Visitor;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Events\Traits\RateLimited;
use Illuminate\Broadcasting\Channel;

class PeopleChanged extends Broadcastable
{
    use Dispatchable, InteractsWithSockets, SerializesModels, RateLimited;
    public $personId;

    /**
     * Create a new congressmanBudget instance.
     *
     * @param $congressmanId
     */
    public function __construct($personId)
    {
        $this->personId = $personId;
    }
    public function broadcastChannelName()
    {
        return new Channel('people');
    }
}
