<?php

namespace App\Http\Requests;

class EventTypeStore extends Request
{
    public function authorize()
    {
        return allows('event_types:store');
    }

    public function rules()
    {
        return [
            'name' => 'required | unique:event_types',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome: preencha o campo corretamente.',
            'name.unique' => 'Nome: tipo de ocorrência já existente.',
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
