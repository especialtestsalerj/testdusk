<?php

namespace App\Http\Requests;

use App\Models\Sector;
use App\Rules\PersonOnVisit;
use App\Rules\ValidCPF;
use Illuminate\Validation\Rule;

class AgendamentoIndex extends Request
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

            'building_id' =>        ['required'],

        ];
    }

    public function attributes()
    {
        return [
            'building_id'=>'Edifício',

        ];

    }

    public function messages()
    {
        return [
            'motive.required' => 'Por favor escolha o prédio a ser visitado',
        ];
    }
}
