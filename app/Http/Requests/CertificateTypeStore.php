<?php

namespace App\Http\Requests;

class CertificateTypeStore extends Request
{
    public function authorize()
    {
        return allows('certificate-types:store');
    }

    public function rules()
    {
        return [
            'name' => 'required | unique:certificate_types',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Nome: tipo de porte já existente.',
        ];
    }

    public function sanitize(array $all)
    {
        $input = $all;

        if (!empty($this->get('name'))) {
            $input['name'] = convert_case($input['name'], MB_CASE_UPPER);
            $this->replace($input);
        }

        return $input;
    }
}
