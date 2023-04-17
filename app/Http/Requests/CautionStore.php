<?php

namespace App\Http\Requests;

use App\Data\Repositories\Visitors as VisitorsRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CautionStore extends Request
{
    public function authorize()
    {
        return allows('cautions:store');
    }

    public function rules()
    {
        Validator::extend('cpf_inactive', function ($attribute, $value, $parameters, $validator) {
            $input = $validator->getData();

            $visitor = app(VisitorsRepository::class)->findById($input['visitor_id']);

            return !$visitor?->hasCpfActiveOnRoutine() ?? false;
        });

        return [
            'routine_id' => 'required',
            'started_at' => 'required',
            'visitor_id' => 'required|cpf_inactive:visitor_id',
            'certificate_type' => 'required',
            'id_card' => 'required_if:certificate_type,2',
            'certificate_number' => 'required_if:certificate_type,2',
            'certificate_valid_until' => 'required_if:certificate_type,2',
            'duty_user_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'started_at.required' => 'Entrada: preencha o campo corretamente.',
            'visitor_id.required' => 'Visitante: preencha o campo corretamente.',
            'visitor_id.cpf_inactive' => 'Visitante: possui cautela em aberto.',
            'certificate_type.required' => 'Tipo de Porte: preencha o campo corretamente.',
            'id_card.required_if' => 'RG: preencha o campo corretamente.',
            'certificate_number.required_if' => 'Núm. Certificado: preencha o campo corretamente.',
            'certificate_valid_until.required_if' =>
                'Validade Certificado: preencha o campo corretamente.',
            'duty_user_id.required' => 'Plantonista: preencha o campo corretamente.',
        ];
    }
}
