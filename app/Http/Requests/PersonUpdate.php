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
            'disabilities' => 'required_if:has_disability,true',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute: preencha o campo corretamente.',
            'required_if' => ':attribute: preencha o campo corretamente.',
            'required_unless' => ':attribute: preencha o campo corretamente.',
        ];
    }

    public function attributes()
    {
        return [
            'full_name' => 'Nome Completo',
            'country_id' => 'País',
            'state_id' => 'Estado',
            'city_id' => 'Cidade',
            'other_city' => 'Cidade',
            'disabilities' => 'Tipo de Deficiência',
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
