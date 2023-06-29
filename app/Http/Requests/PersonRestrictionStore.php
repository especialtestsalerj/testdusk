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
            'document_number' => ['bail', 'required', 'cpf'],
            'full_name' => 'required',
            'started_at' => 'required',
            'ended_at' => ['bail', 'nullable', 'after_or_equal:started_at'],
            'message' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'cpf.required' => 'CPF: preencha o campo corretamente.',
            'cpf.cpf' => 'CPF: número inválido.',
            'full_name.required' => 'Nome: preencha o campo corretamente.',
            'started_at.required' => 'Início: preencha o campo corretamente.',
            'ended_at.after_or_equal' => 'A Data de Término deve ser posterior à data de início.',
            'message.required' => 'Mensagem: preencha o campo corretamente.',
            'description.required' => 'Descrição: preencha o campo corretamente.',
        ];
    }
}
