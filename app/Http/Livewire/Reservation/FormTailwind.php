<?php

namespace App\Http\Livewire\Reservation;

use App\Data\Repositories\Buildings;
use App\Data\Repositories\Countries as CountriesRepository;
use App\Data\Repositories\DisabilityTypes as DisabilityTypesRepository;
use App\Data\Repositories\DocumentTypes;
use App\Data\Repositories\Genders as GendersRepository;
use App\Data\Repositories\Sectors;
use App\Data\Repositories\States as StatesRepository;
use App\Http\Livewire\BaseForm;
use App\Http\Livewire\Traits\Addressable;
use App\Models\BlockedDate;
use App\Models\Country;
use App\Models\Sector;
use App\Models\Capacity;
use Livewire\Component;

class FormTailwind extends Form
{

    public function render()
    {

        $this->documentTypes = app(DocumentTypes::class)->allActive();
        $this->loadCountryBr();
        $this->loadDefaultLocation();



        return view('livewire.reservation.form-tailwind')->with($this->getViewVariables());
    }


}
