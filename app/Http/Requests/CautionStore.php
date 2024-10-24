<?php

namespace App\Http\Requests;

use App\Rules\VisitorHasNoOpenCaution;
use App\Rules\ValidPeriodOnRoutine;
use App\Data\Repositories\Cautions as CautionsRepository;
use Illuminate\Validation\Rule;

class CautionStore extends Request
{
    public function authorize()
    {
        return allows_in_current_building('cautions:store');
    }

    public function rules()
    {
        $id = $this->get('id');
        $caution = isset($id) ? app(CautionsRepository::class)->findById($id) : null;

        return [
            'routine_id' => 'required',
            'started_at' => [
                'bail',
                'required',
                new ValidPeriodOnRoutine(
                    $this->get('routine_id'),
                    $this->get('started_at'),
                    'A Data da Abertura deve ser posterior à assunção da rotina.',
                    $caution?->old_id
                ),
            ],
            'concluded_at' => [
                'bail',
                'nullable',
                new ValidPeriodOnRoutine(
                    $this->get('routine_id'),
                    $this->get('concluded_at'),
                    'A Data do Fechamento deve ser posterior à assunção da rotina.'
                ),
                'after_or_equal:started_at',
            ],
            'visitor_id' => [
                'bail',
                'required',
                new VisitorHasNoOpenCaution($this->get('visitor_id'), $this->get('id')),
            ],
            'certificate_type_id' => 'required',
            'certificate_number' => 'required',
            'certificate_valid_until' =>
                'required_if:certificate_type_id,' . config('app.certificate_type_particular'),
            'duty_user_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'started_at.required' => 'Abertura: preencha o campo corretamente.',
            'concluded_at.after_or_equal' =>
                'A Data do Fechamento deve ser posterior à abertura da cautela.',
            'visitor_id.required' => 'Visitante: preencha o campo corretamente.',
            'certificate_type_id.required' => 'Tipo de Porte: preencha o campo corretamente.',
            'certificate_number.required' =>
                'Núm. Certificado/Matrícula: preencha o campo corretamente.',
            'certificate_valid_until.required_if' =>
                'Validade Certificado: preencha o campo corretamente.',
            'duty_user_id.required' => 'Plantonista: preencha o campo corretamente.',
        ];
    }
}
