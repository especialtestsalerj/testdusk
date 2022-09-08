<?php

namespace App\Data\Repositories;

use App\Models\Event;

class Events extends Repository
{
    /**
     * @var string
     */
    protected $model = Event::class;
}
