<?php

namespace App\Http\Requests;

class StuffStore extends Request
{
    public function authorize()
    {
        return allows('stuffs:store');
    }

    public function rules()
    {
        return [
            'routine_id' => 'required',
            'entranced_at' => 'required',
            'exited_at' => 'required',
            'duty_user_id' => 'required',
            'description' => 'required',
        ];
    }
}
