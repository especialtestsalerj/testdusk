<?php

namespace App\Http\Requests;

class RoutineStore extends Request
{
    public function authorize()
    {
        return allows('routines:store');
    }

    public function rules()
    {
        return [
            'shift_id' => 'required',
            'entranced_at' => 'required',
            'entranced_user_id' => 'required',
            'checkpoint_obs' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'shift_id.required' => 'Turno: preencha o campo corretamente.',
            'entranced_at.required' => 'Data (Assunção): preencha o campo corretamente.',
            'entranced_user_id.required' =>
                'Responsável (Assunção): preencha o campo corretamente.',
            'checkpoint_obs.required' => 'Carga: preencha o campo corretamente.',
        ];
    }
}
