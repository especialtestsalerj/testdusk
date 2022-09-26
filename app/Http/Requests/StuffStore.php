<?php

namespace App\Http\Requests;

class StuffStore extends Request
{
    public function authorize()
    {
        return allows('stuffs:store');
    }

    public function rules()
    {
        return [
            'routine_id' => 'required',
            'entranced_at' => 'required',
            'duty_user_id' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'entranced_at.required' => 'Entrada: preencha o campo corretamente.',
            'duty_user_id.required' => 'Plantonista: preencha o campo corretamente.',
            'description.required' => 'Observações: preencha o campo corretamente.',
        ];
    }
}
