<?php

namespace App\Http\Requests;

class PersonUpdate extends Request
{
    public function authorize()
    {
        return allows('people:update');
    }

    public function rules()
    {
        return [
            'full_name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Nome Completo: preencha o campo corretamente.',
        ];
    }

    public function sanitize(array $all)
    {
        $input = $all;

        if (!empty($this->get('full_name'))) {
            $input['full_name'] = mb_strtoupper($input['full_name']);
            $this->replace($input);
        }

        if (!empty($this->get('social_name'))) {
            $input['social_name'] = mb_strtoupper($input['social_name']);
            $this->replace($input);
        }

        if (!empty($this->get('email'))) {
            $input['email'] = mb_strtolower($input['email']);
            $this->replace($input);
        }

        if (!empty($this->get('other_city'))) {
            $input['other_city'] = mb_strtoupper($input['other_city']);
            $this->replace($input);
        }

        return $input;
    }
}
