<?php

namespace App\Data\Repositories;

use App\Models\CautionWeapon;

class CautionWeapons extends Repository
{
    /**
     * @var string
     */
    protected $model = CautionWeapon::class;

    public function findByCaution($caution_id)
    {
        return $this->model::where('caution_id', $caution_id)->get();
    }
}
