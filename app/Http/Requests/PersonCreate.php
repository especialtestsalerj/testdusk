<?php

namespace App\Http\Requests;

use App\Rules\CpfAvailableOnVisit;

class PersonCreate extends Request
{
    public function authorize()
    {
        return allows('people:store');
    }

    public function rules()
    {
        return [
            'full_name' => 'required',
            'country_id' => 'required',
            'document_number' => [
                'bail',
                'required',
                'unique:documents,number',
                new CpfAvailableOnVisit(
                    $this->get('id'),
                    $this->get('document_number'),
                    $this->get('document_type_id')
                )],
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
            'document_number.unique'=>'Pessoa Já Cadastrada no sistema.',
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
