<?php

namespace App\Http\Requests;

use App\Models\Sector;
use App\Rules\PersonOnVisit;
use App\Rules\ValidCPF;
use Illuminate\Validation\Rule;

class AgendamentoStore extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        $sectorId = $this->get('sector_id');

        // Verifique se o setor requer o motivo da visita
        $sector = Sector::find($sectorId);
        $requiresMotivation = $sector ? $sector->required_motivation : false;
        return [

//                    'building_id' =>        ['required'],
                    'sector_id' =>          ['required'],
                    'birthdate'=>           ['required'],
                    'reservation_date' => ['required', 'date', 'after_or_equal:today'],
                    'capacity_id' =>       ['required'],
                    'document_type_id' =>   ['required'],
                    'document_number' =>    ['required'],
                    'full_name' =>          ['required'],
//                    'social_name' =>        ['required'],
                    'country_id' =>         ['required'],
                    'state_id' =>           ['required'],
                    'city_id' =>            ['required'],
//                    'other_city' =>         ['required'],
                    'responsible_email' => ['required', 'email'],
                    'confirm_email' => ['required', 'same:responsible_email'],
                    'mobile' =>             ['required'],
                    'motive' => [Rule::requiredIf($requiresMotivation),],
                    'has_disability' =>['required'],
                    'has_group' => ['required'],
                    'institution' => ['required_if:has_group,true'],

        ];
    }

    public function attributes()
    {
        return [
            'building_id'=>'Edifício',
            'sector_id' =>          'Setor',
            'reservation_date' =>       'Data da Visita',
            'capacity_id' =>       'Hora da Vista',
            'document_type_id' =>   'Tipo de Documento',
            'document_number' =>    'Número do Documento',
            'full_name' =>          'Nome Completo',
            'country_id' =>         'País',
            'state_id' =>           'Estado',
            'city_id' =>            'Cidade',
            'email' =>              'E-mail',
            'confirm_email' =>      'Confirmação de E-mail',
            'mobile' =>             'Celular',
            'motive'=>'Motivo',
            'birthdate'=>'Nascimento',
            'has_disability'=>'Deficiência',
            'has_group'=>'Visita em Grupo',

        ];

    }

    public function messages()
    {
        return [
            'motive.required' => 'O campo Motivo da Visita é obrigatório para o setor selecionado.',
            'institution.required_if' => 'Para visita em Grupo é obrigatório a Instituição/Empresa.',
//            'document_type_id.required' => 'Tipo de Documento: preencha o campo corretamente.',
//            'state_document_id.required_if' =>
//                'Estado do Documento: preencha o campo corretamente.',
//            'document_number.required' => 'Número do Documento: preencha o campo corretamente.',
//            'full_name.required' => 'Nome Completo: preencha o campo corretamente.',
//            'country_id.required' => 'País: preencha o campo corretamente.',
//            'state_id.required' => 'Estado: preencha o campo corretamente.',
//            'city_id.required' => 'Cidade: preencha o campo corretamente.',
//            'other_city.required' => 'Cidade: preencha o campo corretamente.',
//            'entranced_at.required' => 'Entrada: preencha o campo corretamente.',
//            'exited_at.after_or_equal' => 'A Data de Saída deve ser posterior à entrada da visita.',
//            'sector_id.required' => 'Destino: preencha o campo corretamente.',
//            'description.required' => 'Motivo da Visita: preencha o campo corretamente.',
//            'contact_type_id.required' => 'Tipo de Contato: preencha o campo corretamente.',
//            'contact.required' => 'Contato: preencha o campo corretamente.',
//            'contact.email' => 'Contato: O campo não apresenta um endereço de email válido.',

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
