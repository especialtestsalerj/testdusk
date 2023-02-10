<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class RoutineUpdate extends RoutineStore
{
    public function authorize()
    {
        return allows('routines:update');
    }
}
