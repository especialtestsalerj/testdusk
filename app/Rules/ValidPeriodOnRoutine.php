<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ValidPeriodOnRoutine implements Rule
{
    public $routine_id;
    public $datetime;
    public $message;
    public $exception;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($routine_id, $datetime, $message, $exception = null)
    {
        $this->routine_id = $routine_id;
        $this->datetime = $datetime;
        $this->message = $message;
        $this->exception = $exception;
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
        if (isset($this->exception)) {
            return true;
        }

        $query = DB::table('routines')
            ->where('id', $this->routine_id)
            ->where('entranced_at', '>', $this->datetime);

        return $query->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
