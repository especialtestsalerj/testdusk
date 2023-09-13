<?php

namespace App\Http\Livewire\Traits;

use App\Data\Repositories\Cautions as CautionsRepository;
use App\Data\Repositories\CautionWeapons as CautionWeaponsRepository;

trait CautionReceipt
{
    public $caution;
    public $cautionWeapons;
    public $logoBlob;

    public function generateCautionReceipt($id)
    {
        $this->printCaution = null;
        $this->cautionWeapons = null;

        $this->logoBlob = base64_encode(file_get_contents(public_path('img/logo-alerj.png')));
        $this->caution = app(CautionsRepository::class)->findById($id);
        $this->cautionWeapons = app(CautionWeaponsRepository::class)->getByCautionId(
            $this->caution->id
        );

        $this->dispatchBrowserEvent('printCautionReceipt');
    }
}
