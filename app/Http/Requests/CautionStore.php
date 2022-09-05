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
            'concluded_at' => 'required',
            'duty_user_id' => 'required',
            'person_id' => 'required',
            'destiny_sector_id' => 'required',
        ];
    }
}
