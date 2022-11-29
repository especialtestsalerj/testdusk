<?php

namespace App\Http\Requests;

class VisitorCaution extends VisitorUpdate
{
    public function sanitize(array $all)
    {
        $input = $all;

        if (!empty($this->get('id_card'))) {
            $input['id_card'] = mb_strtoupper($input['id_card']);
            $this->replace($input);
        }

        if (!empty($this->get('certificate_number'))) {
            $input['certificate_number'] = mb_strtoupper($input['certificate_number']);
            $this->replace($input);
        }

        return $input;
    }
}
