<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoutineUpdate extends RoutineStore
{
    public function authorize()
    {
        return allows_in_current_building('routines:update');
    }
}
