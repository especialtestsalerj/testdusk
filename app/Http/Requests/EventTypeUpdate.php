<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class EventTypeUpdate extends EventTypeStore
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', Rule::unique('event_types')->ignore($this->get('id'))],
            'status' => 'required',
        ];
    }
}
