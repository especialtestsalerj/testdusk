<?php

namespace App\Http\Requests;

class RoutineFinish extends RoutineUpdate
{
    public function authorize()
    {
        return allows_in_current_building('routines:update');
    }
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
