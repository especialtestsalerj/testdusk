<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ValidPeriodOnCaution implements Rule
{
    public $caution_id;
    public $datetime;
    public $message;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($caution_id, $datetime, $message)
    {
        $this->caution_id = $caution_id;
        $this->datetime = $datetime;
        $this->message = $message;
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
        $query = DB::table('cautions')
            ->where('id', $this->caution_id)
            ->where('started_at', '>', $this->datetime);

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
