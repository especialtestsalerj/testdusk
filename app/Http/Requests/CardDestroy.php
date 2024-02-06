<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CardDestroy extends CardStore
{
    public function authorize()
    {
        return allows_in_current_building('cards:destroy');
    }

//    TODO: Alterar essa rule
    public function rules()
    {
        return [
            'id' => [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'id.unique' => 'Cartão está em uso.',
        ];
    }
}
