<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class VisitorUpdate extends VisitorStore
{
    public function rules()
    {
        return [
            'routine_id' => 'required',
            'entranced_at' => 'required',
            'exited_at' => 'required',
            'duty_user_id' => 'required',
            'person_id' => 'required',
            'description' => 'required',
        ];
    }
}
