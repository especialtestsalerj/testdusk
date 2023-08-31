<?php

namespace App\Http\Requests;

class SectorStore extends Request
{
    public function authorize()
    {
        return allows('sectors:store');
    }

    public function rules()
    {
        return [
            'name' => 'required | unique:sectors',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Nome: setor já existente.',
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
