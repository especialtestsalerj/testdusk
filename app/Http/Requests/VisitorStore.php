<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VisitorStore extends Request
{
    public function authorize()
    {
        return allows('visitors:store');
    }

    public function rules()
    {
        Validator::extend('cpf_inactive', function ($attribute, $value, $parameters, $validator) {
            $input = $validator->getData();

            return !DB::table('visitors')
                ->join('people', 'visitors.person_id', '=', 'people.id')
                ->where('visitors.routine_id', $input['routine_id'])
                ->where('people.cpf', $input['cpf'])
                ->whereNull('visitors.exited_at')
                ->exists();
        });

        return [
            'routine_id' => 'required',
            'entranced_at' => 'required',
            'cpf' => 'required|cpf|cpf_inactive:id,routine_id,cpf',
            'full_name' => 'required',
            'sector_id' => 'required',
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
            'cpf.cpf_inactive' => 'CPF (Visitante): possui visita em aberto.',
            'full_name.required' => 'Nome (Visitante): preencha o campo corretamente.',
            'sector_id.required' => 'Setor: preencha o campo corretamente.',
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
