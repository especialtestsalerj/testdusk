<?php

namespace App\Http\Requests;

use App\Rules\CpfAvailableOnVisit;
use App\Rules\ValidPeriodOnRoutine;
use App\Data\Repositories\Visitors as VisitorsRepository;

class VisitorStore extends Request
{
    public function authorize()
    {
        return allows('visitors:store');
    }

    public function rules()
    {
        $id = $this->get('id');
        $visitor = isset($id) ? app(VisitorsRepository::class)->findById($id) : null;

        return [
            'routine_id' => 'required',
            'entranced_at' => [
                'bail',
                'required',
                new ValidPeriodOnRoutine(
                    $this->get('routine_id'),
                    $this->get('entranced_at'),
                    'A Data da Entrada deve ser posterior à assunção da rotina.',
                    $visitor?->old_id
                ),
            ],
            'exited_at' => [
                'bail',
                'nullable',
                new ValidPeriodOnRoutine(
                    $this->get('routine_id'),
                    $this->get('exited_at'),
                    'A Data da Saída deve ser posterior à assunção da rotina.'
                ),
                'after_or_equal:entranced_at',
            ],
            'cpf' => [
                'bail',
                'required',
                'cpf',
                new CpfAvailableOnVisit(
                    $this->get('id'),
                    $this->get('routine_id'),
                    $this->get('cpf')
                ),
            ],
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
            'exited_at.after_or_equal' => 'A Data de Saída deve ser posterior à entrada da visita.',
            'cpf.required' => 'CPF (Visitante): preencha o campo corretamente.',
            'cpf.cpf' => 'CPF (Visitante): número inválido.',
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
