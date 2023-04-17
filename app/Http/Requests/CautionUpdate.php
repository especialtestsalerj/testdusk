<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CautionUpdate extends CautionStore
{
    public function authorize()
    {
        return allows('cautions:update');
    }

    public function rules()
    {
        return [
            'routine_id' => 'required',
            'started_at' => 'required',
            'visitor_id' => 'required',
            'certificate_type' => 'required',
            'id_card' => 'required_if:certificate_type,2',
            'certificate_number' => 'required_if:certificate_type,2',
            'certificate_valid_until' => 'required_if:certificate_type,2',
            'duty_user_id' => 'required',
        ];
    }
}
