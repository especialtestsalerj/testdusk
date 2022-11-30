<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class RoutineFinish extends RoutineUpdate
{
    public function rules()
    {
        return [
            'exited_at' => 'required',
            'exited_user_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'exited_at.required' => 'Data (Passagem): preencha o campo corretamente.',
            'exited_user_id.required' => 'Responsável (Passagem): preencha o campo corretamente.',
        ];
    }
}
