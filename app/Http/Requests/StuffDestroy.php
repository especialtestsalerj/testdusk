<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class StuffDestroy extends StuffStore
{
    public function authorize()
    {
        return allows('stuffs:destroy');
    }

    public function rules()
    {
        return [];
    }
}
