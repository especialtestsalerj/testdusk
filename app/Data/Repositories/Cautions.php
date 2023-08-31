<?php

namespace App\Data\Repositories;

use App\Models\Caution;

class Cautions extends Repository
{
    /**
     * @var string
     */
    protected $model = Caution::class;

    //Return the next protocol number for the year of creation of the new caution
    public function makeProtocolNumber($ano)
    {
        $new_number =
            $this->model
                ::whereRaw("DATE_PART('year', started_at) = " . $ano)
                ->max('protocol_number') + 1;
        $new_number =
            $new_number == '1' ? $ano . str_pad($new_number, 4, '0', STR_PAD_LEFT) : $new_number;

        return $new_number;
    }

    public function findOld($oldId)
    {
        return $this->model
            ::where('old_id', $oldId)
            ->whereNotNull('old_id')
            ->get();
    }

    public function findByCertificate($personId, $certificateTypeId)
    {
        return $this->model
            ::select(
                'cautions.certificate_type_id',
                'cautions.certificate_number',
                'cautions.certificate_valid_until'
            )
            ->join('visitors', 'cautions.visitor_id', '=', 'visitors.id')
            ->where('visitors.person_id', $personId)
            ->where('cautions.certificate_type_id', $certificateTypeId)
            ->distinct()
            ->first();
    }
}
