<?php

namespace App\Http\Requests;

class SectorStore extends Request
{
    public function authorize()
    {
        return allows('sectors:store');
    }

    public function rules()
    {
        return [
            'name' => 'required | unique:sectors',
            'status' => 'required',
        ];
    }
}
