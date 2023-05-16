<?php

namespace App\Http\Requests;

class PersonRestrictionDestroy extends PersonRestrictionStore
{
    public function authorize()
    {
        return allows('person-restrictions:destroy');
    }

    public function rules()
    {
        return [];
    }
}
