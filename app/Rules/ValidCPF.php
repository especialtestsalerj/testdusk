<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Services\CpfCnpj\CpfCnpj;

class ValidCPF implements Rule
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
        $cpf = new CpfCnpj($value);
        return $cpf->validateCpf();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'CPF: número inválido.';
    }
}
