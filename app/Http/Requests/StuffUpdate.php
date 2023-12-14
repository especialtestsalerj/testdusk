<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class StuffUpdate extends StuffStore
{
    public function authorize()
    {
        return allows_in_current_building('stuffs:update');
    }
}
