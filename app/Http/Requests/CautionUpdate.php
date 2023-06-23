<?php

namespace App\Http\Requests;

use App\Data\Repositories\Cautions as CautionsRepository;
use App\Rules\ValidPeriodOnRoutine;

class CautionUpdate extends CautionStore
{
    public function authorize()
    {
        return allows('cautions:update');
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
            'visitor_id' => ['bail', 'required'],
            'certificate_type' => 'required',
            'id_card' => 'required_if:certificate_type,2',
            'certificate_number' => 'required_if:certificate_type,2',
            'certificate_valid_until' => 'required_if:certificate_type,2',
            'duty_user_id' => 'required',
        ];
    }
}
