<?php

namespace App\Http\Requests;

use App\Rules\ShiftNotExists;
use App\Rules\ValidShiftInterval;
use App\Rules\ValidRoutinePeriod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
            'entranced_at' => ['required'],
            'entranced_user_id' => 'required',
            'checkpoint_obs' => 'required',
            'exited_at' => ['bail', 'nullable', 'after:entranced_at'],
        ];
    }

    public function messages()
    {
        return [
            'shift_id.required' => 'Turno: preencha o campo corretamente.',
            'entranced_at.required' => 'Data (Assunção): preencha o campo corretamente.',
            'entranced_user_id.required' =>
                'Responsável (Assunção): preencha o campo corretamente.',
            'exited_at.after' => 'Data (Passagem): deve ser maior que a data (assunção).',
        ];
    }
}
