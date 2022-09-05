<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class RoutineUpdate extends RoutineStore
{
    public function rules()
    {
        return [
            'shift_id' => 'required',
            'entranced_at' => 'required',
            'entranced_user_id' => 'required',
        ];
    }
}
