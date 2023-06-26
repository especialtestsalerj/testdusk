<?php

namespace App\Rules;

use App\Data\Repositories\Visitors as VisitorsRepository;
use Illuminate\Contracts\Validation\Rule;

class VisitorHasNoOpenCaution implements Rule
{
    public $visitor_id;
    public $caution_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($visitor_id, $caution_id)
    {
        $this->visitor_id = $visitor_id;
        $this->caution_id = $caution_id;
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
        $visitor = app(VisitorsRepository::class)->findById($this->visitor_id);

        return !$visitor?->hasOpenCaution($this->caution_id) ?? false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Visitante: possui cautela em aberto.';
    }
}
