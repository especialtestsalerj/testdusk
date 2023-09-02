<?php

namespace App\Http\Requests;

class PersonRestrictionStore extends Request
{
    public function authorize()
    {
        return allows('person-restrictions:store');
    }

    public function rules()
    {
        return [
            'person_id' => 'required',
            'started_at' => 'required',
            'ended_at' => ['bail', 'nullable', 'after_or_equal:started_at'],
            'message' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'person_id.required' => 'Pessoa: preencha o campo corretamente.',
            'started_at.required' => 'Início: preencha o campo corretamente.',
            'ended_at.after_or_equal' => 'A Data de Término deve ser posterior à data de início.',
            'message.required' => 'Mensagem: preencha o campo corretamente.',
            'description.required' => 'Descrição: preencha o campo corretamente.',
        ];
    }
}
