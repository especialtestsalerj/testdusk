<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class PersonRestrictionUpdate extends PersonRestrictionStore
{
    public function authorize()
    {
        return allows('person-restrictions:update');
    }
}
