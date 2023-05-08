<?php

namespace App\Http\Requests;

use App\Rules\ValidPeriodOnRoutine;

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
            'occurred_at' => [
                'bail',
                'required',
                new ValidPeriodOnRoutine(
                    $this->get('routine_id'),
                    $this->get('occurred_at'),
                    'A Data da Ocorrência deve ser posterior à assunção da rotina.'
                ),
            ],
            'event_type_id' => 'required',
            'duty_user_id' => 'required',
            'description' => 'required',
        ];
    }
}
