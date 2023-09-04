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
            'country_id' => 'required',
            'state_id' => 'required_if:country_id,' . config('app.country_br'),
            'city_id' => 'required_if:country_id,' . config('app.country_br'),
            'other_city' => 'required_unless:country_id,' . config('app.country_br'),
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Nome Completo: preencha o campo corretamente.',
            'country_id.required' => 'País: preencha o campo corretamente.',
            'state_id.required_if' => 'Estado: preencha o campo corretamente.',
            'city_id.required_if' => 'Cidade: preencha o campo corretamente.',
            'other_city.required_unless' => 'Cidade: preencha o campo corretamente.',
        ];
    }

    public function sanitize(array $all)
    {
        $input = $all;

        if (!empty($this->get('full_name'))) {
            $input['full_name'] = convert_case($input['full_name'], MB_CASE_UPPER);
            $this->replace($input);
        }

        if (!empty($this->get('social_name'))) {
            $input['social_name'] = convert_case($input['social_name'], MB_CASE_UPPER);
            $this->replace($input);
        }

        if (!empty($this->get('email'))) {
            $input['email'] = convert_case($input['email'], MB_CASE_LOWER);
            $this->replace($input);
        }

        if (!empty($this->get('other_city'))) {
            $input['other_city'] = convert_case($input['other_city'], MB_CASE_UPPER);
            $this->replace($input);
        }

        return $input;
    }
}
