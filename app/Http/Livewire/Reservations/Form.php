<?php

namespace App\Http\Livewire\Reservations;

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

class Form extends BaseForm
{

    use Addressable;

    public $sectors =[];
    public $documentTypes;
    public $document_type_id;
    public $sector_id;
    public $building_id;

    public $sector;

    public $document_number;

    public $institution;
    public $full_name;
    public $social_name;

    public $responsible_email;
    public $confirm_email;
    public $mobile;

    public $blockedDates;

    public $maxDate;

    public $reservation_date;

    public $motive;

    public $has_disability;

    public $capacity_id;

    public $capacities =[];

    public  $disabilities =[];

    public $quantity;

    public $birthdate;







    public function render()
    {

        $this->documentTypes = app(DocumentTypes::class)->allActive();
        $this->loadCountryBr();
        $this->loadDefaultLocation();



        return view('livewire.reservation.form')->with($this->getViewVariables());
    }

    public function mount(){

        $this->loadSectors();
        $this->blockedDates =[];
        $this->maxDate = 0;
    }

    protected function getComponentVariables()
    {




        return [
//            'buildings' => app(Buildings::class)->allActive(),
            'genders' => app(GendersRepository::class)->allActive(),
            'disabilityTypes' => app(DisabilityTypesRepository::class)->allActive(),
            'countries' => app(CountriesRepository::class)->allActive(),
            'states' => app(StatesRepository::class)->allActive(),
            'country_br' => Country::where('id', '=', config('app.country_br'))->first(),
        ];
    }

    public function loadSectors()
    {
        if(!empty($this->building_id)) {

            $this->sectors = Sector::where('building_id', $this->building_id)->where('is_visitable', 'true')->get();


        }else{
            $this->sectors = [];
        }
    }

    public function loadDates()
    {
        if(!empty($this->sector_id)){
            $dates = BlockedDate::where('sector_id', $this->sector_id)->pluck('date');

            //Array map, para sábados e domingos, holiday date (cadastrar
            //No final do ano faltando X dias para virar o ano, faz o processamento da holiday do próximo ano.
            //Array remove/reduce de exception date.
            //Cadastrar uma tabela de exceções.

            $this->blockedDates = $dates->map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('d/m/Y');
            });

        }else{
            $this->blockedDates =[];

        }
    }

    public function updatedSectorId($newValue)
    {
        if (empty($newValue)) {
            return;

        }



        $this->sector = Sector::where('id',$this->sector_id )->first();

//        dd($this->sector);

        $this->loadDates();
        $this->loadHourCapacities();
        $this->emit('blockedDatesUpdated', $this->blockedDates);
        $this->emit('maxDateUpdated', $this->sector->max_date);
    }

    public function updatedReservationDate($newValue)
    {
        if (empty($newValue)) {
            return;

        }
        $this->loadHourCapacities();

        $this->capacities = collect($this->capacities);

        $this->select2ReloadOptions(
            $this->capacities
                ->map(function ($item) {
                    return [
                        'name' => $item->hour,
                        'value' => $item->id,
                    ];
                })
                ->toArray(),
            'capacity_id'
        );

    }

    public function updatedBuildingId($newValue)
    {
        if (is_null($newValue)) {
            return;

        }
        $this->loadSectors();

        $this->sectors = collect($this->sectors);

        $this->select2ReloadOptions(
            $this->sectors
                ->map(function ($sector) {
                    return [
                        'name' => convert_case($sector->nickname, MB_CASE_UPPER),
                        'value' => $sector->id,
                    ];
                })
                ->toArray(),
            'sector_id'
        );

        if ($this->sector_id) {
            $this->select2SelectOption('sector_id', $this->sector_id);
        }
    }

    public function loadHourCapacities()
    {


        if (!empty($this->sector_id) && !empty($this->reservation_date)) {


            $date = \DateTime::createFromFormat('d/m/Y', $this->reservation_date)->format('Y-m-d');

            if ($this->sector->display_remaining_vacancies){
                $this->capacities = \DB::table('capacities as c')
                    ->select('c.id', \DB::raw("c.hour || ' (' || (c.maximum_capacity - (
                select count(*) from reservations r
                where r.sector_id = c.sector_id
                  and r.reservation_date = '$date'
                  and r.capacity_id = c.id)) || ' vagas)' as hour"))
                    ->where('c.sector_id', $this->sector_id)
                    ->having(\DB::raw("(c.maximum_capacity - (
            select count(*) from reservations r
            where r.sector_id = c.sector_id
              and r.reservation_date = '$date'
              and r.capacity_id = c.id))"), '>', 0)
                    ->groupBy('c.id', 'c.hour')
                    ->orderBy('c.hour')
                    ->get();
            } else {
                $this->capacities = \DB::table('capacities as c')
                    ->select('c.id', 'c.hour')
                    ->where('c.sector_id', $this->sector_id)
                    ->having(\DB::raw("(c.maximum_capacity - (
            select count(*) from reservations r
            where r.sector_id = c.sector_id
              and r.reservation_date = '$date'
              and r.capacity_id = c.id))"), '>', 0)
                    ->groupBy('c.id', 'c.hour')
                    ->orderBy('c.hour')
                    ->get();
            }
    }else{
            $this->capacities =[];
        }
    }


}
