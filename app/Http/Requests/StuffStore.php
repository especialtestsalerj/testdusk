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
            'entranced_at' => 'required_if:exited_at,null',
            'duty_user_id' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'entranced_at.required_if' => 'Entrada ou Saída: informe pelo menos uma das datas.',
            'duty_user_id.required' => 'Plantonista: preencha o campo corretamente.',
            'description.required' => 'Observações: preencha o campo corretamente.',
        ];
    }
}
