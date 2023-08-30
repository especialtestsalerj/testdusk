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
            'country_id' => 'required',
            'state_id' => 'required_if:country_id,'.env('APP_COUNTRY_BR'),
            'city_id' => 'required_if:country_id,'.env('APP_COUNTRY_BR'),
            'other_city' => 'required_unless:country_id,'.env('APP_COUNTRY_BR'),
            'entranced_at' => ['bail', 'required'],
            'exited_at' => ['bail', 'nullable', 'after_or_equal:entranced_at'],
            'sector_id' => 'required',
            'description' => 'required',
        ];
    }
    //currency, !=, 0",
    public function messages()
    {
        return [
            'document_type_id.required' => 'Tipo de Documento: preencha o campo corretamente.',
            'document_number.required' => 'Documento: preencha o campo corretamente.',
            'full_name.required' => 'Nome Completo: preencha o campo corretamente.',
            'country_id.required' => 'País: preencha o campo corretamente.',
            'state_id.required_if' => 'Estado: preencha o campo corretamente.',
            'city_id.required_if' => 'Cidade: preencha o campo corretamente.',
            'other_city.required_unless' => 'Cidade: preencha o campo corretamente.',
            'entranced_at.required' => 'Entrada: preencha o campo corretamente.',
            'exited_at.after_or_equal' => 'A Data de Saída deve ser posterior à entrada da visita.',
            'sector_id.required' => 'Destino: preencha o campo corretamente.',
            'description.required' => 'Motivo da Visita: preencha o campo corretamente.',
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
