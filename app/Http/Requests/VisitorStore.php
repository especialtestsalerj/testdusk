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
            'cpf' => 'required|cpf',
            'full_name' => 'required',
            'duty_user_id' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'entranced_at.required' => 'Entrada: preencha o campo corretamente.',
            'cpf.required' => 'CPF (Visitante): preencha o campo corretamente.',
            'cpf.cpf' => 'CPF (Visitante): número inválido.',
            'full_name.required' => 'Nome (Visitante): preencha o campo corretamente.',
            'duty_user_id.required' => 'Plantonista: preencha o campo corretamente.',
            'description.required' => 'Observações: preencha o campo corretamente.',
        ];
    }

    public function sanitize(array $all)
    {
        $input = $all;

        if (!empty($this->get('cpf'))) {
            $input['cpf'] = only_numbers($input['cpf']);

            $this->replace($input);
        }

        return $input;
    }

    /*
    public function sanitize(array $all)
    {
        if (!empty($this->get('cpf'))) {
            $input = $this->all();

            $input['cpf'] = only_numbers($input['cpf']);

            $this->replace($input);
        }

        return $this->all();
    }*/
}
