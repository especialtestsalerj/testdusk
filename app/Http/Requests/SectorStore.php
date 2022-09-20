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
            'name.required' => 'Nome: preencha o campo corretamente.',
            'name.unique' => 'Nome: setor já existente.',
            'status.required' => 'Status: preencha o campo corretamente.',
        ];
    }

    public function sanitize(array $all)
    {
        if (!empty($this->get('name'))) {
            $input = $all;
            $input['name'] = mb_strtoupper($input['name']);
            $this->replace($input);
        }

        return $all;
    }
}
