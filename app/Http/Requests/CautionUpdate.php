<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CautionUpdate extends CautionStore
{
    public function authorize()
    {
        return allows('cautions:update');
    }
}
