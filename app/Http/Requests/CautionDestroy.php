<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CautionDestroy extends CautionStore
{
    public function authorize()
    {
        return allows_in_current_building('cautions:destroy');
    }

    public function rules()
    {
        return [];
    }
}
