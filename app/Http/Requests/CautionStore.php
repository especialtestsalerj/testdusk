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
            'certificate_type' => 'required',
            'id_card' => 'required',
            'certificate_number' => 'required',
            'certificate_valid_until' => 'required',
            'destiny_sector_id' => 'required',
            'duty_user_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'started_at.required' => 'Entrada: preencha o campo corretamente.',
            'visitor_id.required' => 'Visitante: preencha o campo corretamente.',
            'certificate_type.required' => 'Tipo de Porte: preencha o campo corretamente.',
            'id_card.required' => 'RG: preencha o campo corretamente.',
            'certificate_number.required' => 'Núm. Certificado: preencha o campo corretamente.',
            'certificate_valid_until.required' =>
                'Validade Certificado: preencha o campo corretamente.',
            'destiny_sector_id.required' => 'Destino: preencha o campo corretamente.',
            'duty_user_id.required' => 'Plantonista: preencha o campo corretamente.',
        ];
    }
}
