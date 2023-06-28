<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CpfAvailableOnVisit implements Rule
{
    public $id;
    public $routine_id;
    public $cpf;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id, $routine_id, $cpf)
    {
        $this->id = $id;
        $this->routine_id = $routine_id;
        $this->cpf = $cpf;
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
        $query = DB::table('visitors')
            ->join('people', 'visitors.person_id', '=', 'people.id')
            ->join('documents', 'visitors.person_id', '=', 'documents.person_id')
            ->where('documents.number', $this->cpf)
            ->whereNull('visitors.exited_at');

        if (!is_null($this->id)) {
            $query->where('visitors.id', '<>', $this->id);
        }

        return $query->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'CPF (Visitante): possui visita em aberto.';
    }
}
