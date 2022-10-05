<?php

namespace App\Http\Requests;

class CautionStore extends Request
{
    public function authorize()
    {
        return allows('cautions:store');
    }

    public function rules()
    {
        return [
            'routine_id' => 'required',
            'started_at' => 'required',
            'cpf' => 'required|cpf',
            'full_name' => 'required',
            'destiny_sector_id' => 'required',
            'duty_user_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'started_at.required' => 'Entrada: preencha o campo corretamente.',
            'cpf.required' => 'CPF (Visitante): preencha o campo corretamente.',
            'cpf.cpf' => 'CPF (Visitante): número inválido.',
            'full_name.required' => 'Nome (Visitante): preencha o campo corretamente.',
            'destiny_sector_id.required' => 'Destino: preencha o campo corretamente.',
            'duty_user_id.required' => 'Plantonista: preencha o campo corretamente.',
        ];
    }

    public function sanitize(array $all)
    {
        $input = $all;

        if (!empty($this->get('cpf'))) {
            $input['cpf'] = only_numbers($input['cpf']);
            $this->replace($input);
        }

        if (!empty($this->get('full_name'))) {
            $input['full_name'] = mb_strtoupper($input['full_name']);
            $this->replace($input);
        }

        if (!empty($this->get('origin'))) {
            $input['origin'] = mb_strtoupper($input['origin']);
            $this->replace($input);
        }

        return $input;
    }
}
