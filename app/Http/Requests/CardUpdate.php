<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CardUpdate extends SectorStore
{
    public function authorize()
    {
        return allows_in_current_building('cards:update');
    }

    public function rules()
    {
        return [
            'status' => 'required',
        ];
    }
}
