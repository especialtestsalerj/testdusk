<?php

namespace App\Http\Requests;

class CardStore extends Request
{
    public function authorize()
    {
        return allows_in_current_building('cards:store');
    }

    public function rules()
    {
        return [
            'number' => 'required | unique:cards',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'number.unique' => 'Número: Cartão já existente.',
        ];
    }

    public function sanitize(array $all)
    {
        $input = $all;

        if (!empty($this->get('number'))) {
            $input['number'] = convert_case($input['number'], MB_CASE_UPPER);
            $this->replace($input);
        }

        return $input;
    }
}
