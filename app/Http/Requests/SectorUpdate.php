<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class SectorUpdate extends SectorStore
{
    public function authorize()
    {
        return allows_in_current_building('sectors:update');
    }

    public function rules()
    {
        return [
            'name' => ['required', Rule::unique('sectors')->ignore($this->get('id'))],
            'status' => 'required',
        ];
    }
}
