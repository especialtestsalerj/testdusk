<?php

namespace App\Http\Requests;

class CautionStore extends Request
{
    public function authorize()
    {
        return allows('cautions:store');
    }

    public function rules()
    {
        return [
            'routine_id' => 'required',
            'started_at' => 'required',
            'visitor_id' => 'required',
            'destiny_sector_id' => 'required',
            'duty_user_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'started_at.required' => 'Entrada: preencha o campo corretamente.',
            'visitor_id.required' => 'Visitante: preencha o campo corretamente.',
            'destiny_sector_id.required' => 'Destino: preencha o campo corretamente.',
            'duty_user_id.required' => 'Plantonista: preencha o campo corretamente.',
        ];
    }
}
