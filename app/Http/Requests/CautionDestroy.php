<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CautionDestroy extends CautionStore
{
    public function authorize()
    {
        return allows('cautions:destroy');
    }

    public function rules()
    {
        return [];
    }
}
