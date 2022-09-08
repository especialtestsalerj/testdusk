<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CautionUpdate extends CautionStore
{
    public function rules()
    {
        return [
            'routine_id' => 'required',
            'started_at' => 'required',
            'concluded_at' => 'required',
            'duty_user_id' => 'required',
            'person_id' => 'required',
            'destiny_sector_id' => 'required',
        ];
    }
}
