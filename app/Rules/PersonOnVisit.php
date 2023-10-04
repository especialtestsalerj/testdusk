<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class PersonOnVisit implements Rule
{
    public $id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (is_null($this->id)) {
            return true;
        }

        $query = DB::table('visitors')
            ->where('person_id', $this->id)
            ->whereNull('exited_at');

        return $query->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Pessoa possui visita em aberto.';
    }
}
