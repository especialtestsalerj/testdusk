<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CertificateTypeDestroy extends CertificateTypeStore
{
    public function authorize()
    {
        return allows('certificate-types:destroy');
    }

    public function rules()
    {
        return [
            'id' => ['required', Rule::unique('cautions', 'certificate_type_id')],
        ];
    }

    public function messages()
    {
        return [
            'id.unique' => 'Existe alguma cautela utilizando esse tipo de porte.',
        ];
    }
}
