<?php

namespace App\Http\Requests;

class AgendamentoRecover extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
       return [ 'documentNumber' => 'required',
            'g-recaptcha-response' => 'required',
           ]; // o token do reCAPTCHA
    }

    public function attributes()
    {
        return [
            'documentNumber' => 'Documento',
            'g-recaptcha-response' => 'Recaptcha',
            ];

    }
}
