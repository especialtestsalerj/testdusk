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
            'entranced_at' => [
                'bail',
                'required',
            ],
            'exited_at' => [
                'bail',
                'nullable',
                'after_or_equal:entranced_at',
            ],
            'document_type_id' => 'required',
            'document_number' => [
                'bail',
                'required',
                new CpfAvailableOnVisit(
                    $this->get('id'),
                    $this->get('document_number'),
                    $this->get('document_type_id')
                ),
            ],
            'full_name' => 'required',
            'sector_id' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'entranced_at.required' => 'Entrada: preencha o campo corretamente.',
            'exited_at.after_or_equal' => 'A Data de Saída deve ser posterior à entrada da visita.',
            'document_type_id.required' => 'Tipo de Documento: preencha o campo corretamente.',
            'document_number.required' => 'Documento: preencha o campo corretamente.',
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
