<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class EventTypeDelete extends EventTypeStore
{
    public function authorize()
    {
        return allows('event-types:update');
    }

    public function rules()
    {
        return [
            'id' => ['required', Rule::unique('events', 'event_type_id')],
        ];
    }

    public function messages()
    {
        return [
            'id.unique' => 'Existe alguma ocorrência utilizando esse tipo de ocorrência.',
        ];
    }
}
