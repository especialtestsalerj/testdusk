<?php

namespace App\Http\Requests;

class VisitorUpdate extends VisitorStore
{
    public function authorize()
    {
        return allows('visitors:update');
    }
}
