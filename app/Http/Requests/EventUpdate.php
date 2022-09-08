<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class EventUpdate extends EventStore
{
    public function rules()
    {
        return [
            'event_type_id' => 'required',
            'occurred_at' => 'required',
            'duty_user_id' => 'required',
            'description' => 'required',
        ];
    }
}
