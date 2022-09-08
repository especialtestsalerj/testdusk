<?php

namespace App\Http\Requests;

class EventStore extends Request
{
    public function authorize()
    {
        return allows('events:store');
    }

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
