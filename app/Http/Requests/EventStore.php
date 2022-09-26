<?php

namespace App\Http\Requests;

class EventStore extends Request
{
    public function authorize()
    {
        return allows('events:store');
    }

    public function rules()
    {
        return [
            'routine_id' => 'required',
            'event_type_id' => 'required',
            'occurred_at' => 'required',
            'duty_user_id' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'event_type_id.required' => 'Tipo: preencha o campo corretamente.',
            'occurred_at.required' => 'Data da Ocorrência: preencha o campo corretamente.',
            'duty_user_id.required' => 'Plantonista: preencha o campo corretamente.',
            'description.required' => 'Observações: preencha o campo corretamente.',
        ];
    }
}
