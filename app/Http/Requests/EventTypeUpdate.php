<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class EventTypeUpdate extends EventTypeStore
{
    public function rules()
    {
        return [
            'name' => ['required', Rule::unique('event_types')->ignore($this->get('id'))],
            'status' => 'required',
        ];
    }
}
