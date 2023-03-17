<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class VisitorDestroy extends VisitorStore
{
    public function authorize()
    {
        return allows('visitors:destroy');
    }

    public function rules()
    {
        return [];
    }
}
