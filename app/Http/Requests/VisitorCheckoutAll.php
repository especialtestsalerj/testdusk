<?php

namespace App\Http\Requests;

class VisitorCheckoutAll extends Request
{
    public function authorize()
    {
        return allows('visitors:update');
    }

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
