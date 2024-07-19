<?php

namespace App\Http\Livewire\Reservations;

use App\Data\Repositories\Countries as CountriesRepository;
use App\Data\Repositories\DisabilityTypes as DisabilityTypesRepository;
use App\Data\Repositories\Genders as GendersRepository;
use App\Data\Repositories\Sectors;
use App\Data\Repositories\States as StatesRepository;
use App\Data\Repositories\Users;
use App\Http\Livewire\BaseForm;
use App\Http\Livewire\Traits\Addressable;
use App\Models\BlockedDate;
use App\Models\Country;
use App\Models\Sector;
use Livewire\Component;

class Modal extends BaseForm
{
    use Addressable;

    protected $listeners = ['associateUserInSector'];
    public $users;

    public $sector;

    public $user_id;

    public $sectors =[];
    public $documentTypes;
    public $document_type_id;
    public $sector_modal_id;
    public $building_id;

    public $document_number;

    public $full_name;
    public $social_name;

    public $responsible_email;
    public $confirm_email;
    public $mobile;

    public $blockedDates;

    public $reservation_date;

    public $motive;

    public $has_disability;

    public $capacity_id;

    public $capacities =[];

    public  $disabilities =[];

    public $reservation;

    public function render()
    {
        $this->loadCountryBr();
        $this->loadDefaultLocation();

        $this->users = app(Users::class)->allWithAbility(make_ability_name_with_current_building('reservation:show'));
        return view('livewire.reservations.modal')->with($this->getViewVariables());
    }

    public function cleanModal()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    public function store()
    {
        $this->sector->users()->attach([$this->user_id]);
        $this->dispatchBrowserEvent('hide-modal', ['target' => 'sector-user-modal']);
        $this->cleanModal();
        $this->emit('associated-sector-user', $this->sector);
        $this->swallSuccess('Novo Usuário Adicionado com Sucesso.');
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

    public function mount(){
        $this->sectors = app(Sectors::class)->allForUser();
    }

    public function loadDates()
    {
        dd($this->sector_modal_id);
        if(!empty($this->sector_modal_id)){
            $dates = BlockedDate::where('sector_id', $this->sector_modal_id)->pluck('date');

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
        if (is_null($newValue)) {
            return;

        }

        $this->loadDates();
        $this->emit('blockedDatesUpdated', $this->blockedDates);
    }


    public function updatedReservationDate($newValue)
    {
        if (is_null($newValue)) {
            return;

        }
        $this->loadHourCapacities();

        $this->capacities = collect($this->capacities);

        $this->select2ReloadOptions(
            $this->capacities
                ->map(function ($item) {
                    return [
                        'name' => $item->maximum_capacity,
                        'value' => $item->id,
                    ];
                })
                ->toArray(),
            'capacity_id'
        );

    }

    protected function loadHourCapacities()
    {


        if(!empty($this->sector_modal_id) && !empty($this->reservation_date)) {

            $date = \DateTime::createFromFormat('d/m/Y', $this->reservation_date)->format('Y-m-d');
            $this->capacities =  \DB::table('capacities as c')
                ->select('c.id', \DB::raw("c.hour, c.hour || ' (' || (c.maximum_capacity - (
            select count(*) from reservations r
            where r.sector_id = c.sector_id
              and r.reservation_date = '$date'
              and r.capacity_id = c.id)) || ' vagas)' as maximum_capacity"))
                ->where('c.sector_id', $this->sector_modal_id)
                ->having(\DB::raw("(c.maximum_capacity - (
        select count(*) from reservations r
        where r.sector_id = c.sector_id
          and r.reservation_date = '$date'
          and r.capacity_id = c.id))"), '>', 0)
                ->groupBy('c.id', 'c.hour', 'c.maximum_capacity')
                ->orderBy('c.hour')
                ->get();
        }
        else{
            $this->capacities =[];
        }
    }
}
