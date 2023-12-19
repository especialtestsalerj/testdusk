<?php

namespace App\Http\Requests;

use App\Rules\ValidPeriodOnRoutine;

class StuffStore extends Request
{
    public function authorize()
    {
        return allows_in_current_building('stuffs:store');
    }

    public function rules()
    {
        return [
            'routine_id' => 'required',
            'entranced_at' => [
                'nullable',
                'required_if:exited_at,null',
                new ValidPeriodOnRoutine(
                    $this->get('routine_id'),
                    $this->get('entranced_at'),
                    'A Data da Entrada deve ser posterior à assunção da rotina.'
                ),
            ],
            'exited_at' => [
                'bail',
                'nullable',
                new ValidPeriodOnRoutine(
                    $this->get('routine_id'),
                    $this->get('exited_at'),
                    'A Data da Saída deve ser posterior à assunção da rotina.'
                ),
                'after_or_equal:entranced_at',
            ],
            'duty_user_id' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'entranced_at.required_if' => 'Entrada ou Saída: informe pelo menos uma das datas.',
            'exited_at.after_or_equal' =>
                'A Data de Saída deve ser posterior à entrada do material.',
            'duty_user_id.required' => 'Plantonista: preencha o campo corretamente.',
            'description.required' => 'Observações: preencha o campo corretamente.',
        ];
    }
}
