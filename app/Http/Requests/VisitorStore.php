<?php

namespace App\Http\Requests;

use App\Rules\PersonOnVisit;
use App\Data\Repositories\Visitors as VisitorsRepository;
use Illuminate\Validation\Rule;

class VisitorStore extends Request
{
    public function authorize()
    {
        return allows('visitors:store');
    }

    public function rules()
    {
        return [
            'document_type_id' => 'required',
            'state_document_id' => 'required_if:document_type_id,' . config('app.document_type_rg'),
            'document_number' => ['bail', 'required', new PersonOnVisit($this->get('person_id'))],
            'full_name' => 'required',
            'country_id' => [
                Rule::requiredIf(function () {
                    return $this->person_id == null;
                }),
            ],
            'state_id' => [
                Rule::requiredIf(function () {
                    return $this->person_id == null &&
                        $this->country_id == config('app.country_br');
                }),
            ],
            'city_id' => [
                Rule::requiredIf(function () {
                    return $this->person_id == null &&
                        $this->country_id == config('app.country_br');
                }),
            ],
            'other_city' => [
                Rule::requiredIf(function () {
                    return $this->person_id == null &&
                        $this->country_id != config('app.country_br');
                }),
            ],
            'entranced_at' => ['bail', 'required'],
            'exited_at' => ['bail', 'nullable', 'after_or_equal:entranced_at'],
            'sector_id' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'document_type_id.required' => 'Tipo de Documento: preencha o campo corretamente.',
            'state_document_id.required_if' =>
                'Estado do Documento: preencha o campo corretamente.',
            'document_number.required' => 'Número do Documento: preencha o campo corretamente.',
            'full_name.required' => 'Nome Completo: preencha o campo corretamente.',
            'country_id.required' => 'País: preencha o campo corretamente.',
            'state_id.required' => 'Estado: preencha o campo corretamente.',
            'city_id.required' => 'Cidade: preencha o campo corretamente.',
            'other_city.required' => 'Cidade: preencha o campo corretamente.',
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
            $input['full_name'] = convert_case($input['full_name'], MB_CASE_UPPER);
            $this->replace($input);
        }

        return $input;
    }
}
