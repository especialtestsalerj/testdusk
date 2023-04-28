<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ShiftNotExists implements Rule
{
    public $routine_id;
    public $shift_id;
    public $entranced_at;
    public $message;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($routine_id, $shift_id, $entranced_at, $message)
    {
        $this->routine_id = $routine_id;
        $this->shift_id = $shift_id;
        $this->entranced_at = $entranced_at;
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
        //Avoiding the same date (without time) and shift
        $query = DB::table('routines')
            ->where('shift_id', $this->shift_id)
            ->whereDate(
                'entranced_at',
                \Carbon\Carbon::parse($this->entranced_at)->format('Y-m-d')
            );

        if (isset($this->routine_id)) {
            $query->where('id', '<>', $this->routine_id);
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
        return $this->message;
    }
}
