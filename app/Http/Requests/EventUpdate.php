<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class EventUpdate extends EventStore
{
    public function authorize()
    {
        return allows_in_current_building('events:update');
    }
}
