<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class VisitorUpdate extends VisitorStore
{
    public function authorize()
    {
        return allows('visitors:update');
    }
}
