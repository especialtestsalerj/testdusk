<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class EventDelete extends EventStore
{
    public function authorize()
    {
        return allows('events:update');
    }

    public function rules()
    {
        return [];
    }
}
