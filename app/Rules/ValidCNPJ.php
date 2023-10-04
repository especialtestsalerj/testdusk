<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Services\CpfCnpj\CpfCnpj;

class ValidCNPJ implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $cnpj = new CpfCnpj($value);
        return $cnpj->validateCnpj();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O CNPJ não é válido.';
    }
}
