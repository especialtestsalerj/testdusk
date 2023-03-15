<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class EventDestroy extends EventStore
{
    public function authorize()
    {
        return allows('events:destroy');
    }

    public function rules()
    {
        return [];
    }
}
