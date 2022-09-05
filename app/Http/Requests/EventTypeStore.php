<?php

namespace App\Http\Requests;

class EventTypeStore extends Request
{
    public function authorize()
    {
        return allows('event_types:store');
    }

    public function rules()
    {
        return [
            'name' => 'required | unique:event_types',
            'status' => 'required',
        ];
    }
}
