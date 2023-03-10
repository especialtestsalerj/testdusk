<?php

namespace App\Http\Livewire\CautionWeapons;

use App\Http\Livewire\BaseForm;
use App\Models\CautionWeapon;
use Carbon\Carbon;
use App\Data\Repositories\CautionWeapons as CautionWeaponsRepository;

class UpdateForm extends CreateForm
{
    public $mode = 'update';

    protected function getComponentVariables()
    {
        return [
            'cautionWeapon' => $this->cautionWeapon,
        ];
    }
}
