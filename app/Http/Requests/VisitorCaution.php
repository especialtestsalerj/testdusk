<?php

namespace App\Http\Requests;

class VisitorCaution extends VisitorUpdate
{
    public function sanitize(array $all)
    {
        $input = $all;

        if (!empty($this->get('id_card'))) {
            $input['id_card'] = convert_case($input['id_card'], MB_CASE_UPPER);
            $this->replace($input);
        }

        if (!empty($this->get('certificate_number'))) {
            $input['certificate_number'] = convert_case(
                $input['certificate_number'],
                MB_CASE_UPPER
            );
            $this->replace($input);
        }

        return $input;
    }
}
