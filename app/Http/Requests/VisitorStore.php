<?php

namespace App\Http\Requests;

class VisitorStore extends Request
{
    public function authorize()
    {
        return allows('visitors:store');
    }

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
