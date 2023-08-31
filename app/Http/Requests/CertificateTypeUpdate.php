<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CertificateTypeUpdate extends CertificateTypeStore
{
    public function authorize()
    {
        return allows('certificate-types:update');
    }

    public function rules()
    {
        return [
            'name' => ['required', Rule::unique('certificate_types')->ignore($this->get('id'))],
            'status' => 'required',
        ];
    }
}
