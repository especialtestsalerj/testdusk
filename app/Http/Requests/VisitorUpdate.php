<?php

namespace App\Http\Requests;

class VisitorUpdate extends VisitorStore
{
    public function authorize()
    {
        return allows('visitors:update');
    }

    public function rules()
    {
        return [
            'routine_id' => 'required',
            'entranced_at' => 'required',
            'cpf' => 'required|cpf',
            'full_name' => 'required',
            'sector_id' => 'required',
            'duty_user_id' => 'required',
            'description' => 'required',
        ];
    }
}
