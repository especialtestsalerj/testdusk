<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class SectorDestroy extends SectorStore
{
    public function authorize()
    {
        return allows('sectors:destroy');
    }

    public function rules()
    {
        return [
            'id' => [
                'required',
                Rule::unique('events', 'sector_id'),
                Rule::unique('visitors', 'sector_id'),
                Rule::unique('stuffs', 'sector_id'),
                Rule::unique('cautions', 'destiny_sector_id'),
            ],
        ];
    }

    public function messages()
    {
        return [
            'id.unique' => 'Setor está em uso em alguma rotina.',
        ];
    }
}
