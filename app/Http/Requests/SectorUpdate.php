<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class SectorUpdate extends SectorStore
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', Rule::unique('sectors')->ignore($this->get('id'))],
            'status' => 'required',
        ];
    }
}
