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
use App\Models\Country;
use App\Models\Sector;
use Livewire\Component;

class Form extends BaseForm
{

    use Addressable;

    public $sectors;
    public $documentTypes;
    public $document_type_id;
    public $sector_id;
    public $building_id;

    public $document_number;

    public $full_name;
    public $social_name;

    public $email;
    public $confirm_email;
    public $mobile;



    public function render()
    {
        Sector::disableGlobalScopes();
        $this->sectors = Sector::whereNotNull('nickname')->where('status', true)->get();
        $this->documentTypes = app(DocumentTypes::class)->allActive();
        Sector::enableGlobalScopes();

        $this->loadCountryBr();

        return view('livewire.reservation.form')->with($this->getViewVariables());
    }

    public function mount(){
        $this->select2SelectOption('sector_id', $this->sector_id);
    }

    protected function getComponentVariables()
    {
//        $disabilityIds = $this->person->disabilities->pluck('id')->toArray();



        return [
            'buildings' => app(Buildings::class)->allActive(),
            'genders' => app(GendersRepository::class)->allActive(),
            'disabilityTypes' => app(DisabilityTypesRepository::class)->allActive(),
            'countries' => app(CountriesRepository::class)->allActive(),
            'states' => app(StatesRepository::class)->allActive(),
            'country_br' => Country::where('id', '=', config('app.country_br'))->first(),
        ];
    }
}
