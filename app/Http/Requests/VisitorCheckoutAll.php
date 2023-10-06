<?php

namespace App\Http\Requests;

class VisitorCheckoutAll extends VisitorUpdate
{
    public function rules()
    {
        return [
            'exited_at' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'exited_at.required' => 'Saída: preencha o campo corretamente.',
        ];
    }
}
