<?php

namespace App\Http\Requests;

class SectorStore extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return allows('event_types:store');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required | unique:sectors',
            'status' => 'required',
        ];
    }
}
