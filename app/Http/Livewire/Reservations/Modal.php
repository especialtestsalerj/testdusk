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
    public $sector_id;
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
    public function render()
    {
        $this->loadCountryBr();
        $this->loadDefaultLocation();

        $this->users = app(Users::class)->allWithAbility(make_ability_name_with_current_building('reservation:show'));
        return view('livewire.reservations.modal')->with($this->getViewVariables());
    }

    public function associateUserInSector(Sector $sector)
    {
        $this->sector = $sector;
        $this->users = $this->users->diff($this->sector->users);

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
        if (is_null($newValue)) {
            return;

        }

        $this->loadDates();
        $this->emit('blockedDatesUpdated', $this->blockedDates);
    }
}
