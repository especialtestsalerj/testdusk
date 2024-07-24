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
use App\Http\Livewire\Traits\Maskable;
use App\Models\BlockedDate;
use App\Models\Country;
use App\Models\Reservation;
use App\Rules\ValidCPF;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Models\Sector as SectorModel;
use App\Data\Repositories\Reservations as ReservationRepository;

class Modal extends BaseForm
{
    use Addressable, Maskable;

    protected $listeners = ['associateUserInSector', 'editReservation'];
    public $users;
    public $sector;
    public $user_id;
    public $sectors = [];
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
    public $capacities = [];
    public $disabilities = [];
    public $reservation;

    protected $validationAttributes = [
        'user_id' => 'Usuário',
        'sector' => 'Setor',
        'document_type_id' => 'Tipo de Documento',
        'state_document_id' => 'Estado do Documento',
        'sector_modal_id' => 'Setor',
        'country_id' => 'País',
        'state_id' => 'Estado',
        'building_id' => 'Prédio',
        'document_number' => 'Número do Documento',
        'full_name' => 'Nome Completo',
        'social_name' => 'Nome Social',
        'responsible_email' => 'Email',
        'confirm_email' => 'Confirmação de Email',
        'mobile' => 'Telefone (DD) + Número',
        'reservation_date' => 'Data da Visita',
        'motive' => 'Motivo da Visita',
        'has_disability' => 'Possui deficiência',
        'disabilities' => 'Tipo de Deficiência',
        'capacity_id' => 'Hora da Visita',
        'city_id' => 'Cidade',
        'other_city' => 'Outra Cidade',
    ];


    public function rules()
    {
        return [
            'document_type_id' => 'required|exists:document_types,id',
            'sector_modal_id' => 'required|exists:sectors,id',
            'country_id' => 'required|exists:countries,id',
            'document_number' => ['bail', 'required', Rule::when($this->document_type_id == config('app.document_type_cpf'), [new ValidCPF()])],
            'full_name' => 'required|string|max:255',
            'social_name' => 'nullable|string|max:255',
            'responsible_email' => 'required|email|max:255',
            'confirm_email' => 'required|email|same:responsible_email',
            'mobile' => 'required|string|max:20',
            'reservation_date' => 'required',
            'motive' => 'required|string|max:500',
            'has_disability' => 'required|boolean',
            'disabilities' => 'required_if:has_disability,true',
            'capacity_id' => 'required|exists:capacities,id',
            'state_id' => 'required_if:country_id,' . config('app.country_br') . '|exists:states,id',
            'city_id' => 'required_if:country_id,' . config('app.country_br') . '|exists:cities,id',
            'other_city' => 'required_unless:country_id,' . config('app.country_br'),
        ];
    }

    public function render()
    {
        $this->applyMasks();
        $this->loadCountryBr();
        $this->loadDefaultLocation();

        $this->users = app(Users::class)->allWithAbility(make_ability_name_with_current_building('reservation:show'));
        return view('livewire.reservations.modal')->with($this->getViewVariables());
    }

    public function cleanModal()
    {
        $this->dispatchBrowserEvent('hide-modal', ['target' => 'sector-user-modal']);
        $this->resetExcept('capacities', 'sectors', 'documentTypes', 'disabilities');
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('hide-modal', ['target' => 'reservation-modal']);
        $this->select2SetReadOnly('city_id', false);
        $this->select2SetReadOnly('sector_modal_id', false);
        $this->select2SetReadOnly('state_id', false);
        $this->select2SetReadOnly('country_id', false);
        $this->select2SetReadOnly('state_document_id', false);
        $this->loadDefault();
    }

    public function store()
    {
        $this->validate();

        $data = [
            'user_id' => $this->user_id,
            'sector_id' => $this->sector_modal_id,
            'reservation_date' => Carbon::createFromFormat('d/m/Y', $this->reservation_date)->format('Y-m-d'),
            'full_name' => $this->full_name,
            'social_name' => $this->social_name,
            'document_type_id' => $this->document_type_id,
            'document_number' => $this->document_number,
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'other_city' => $this->other_city,
            'responsible_email' => $this->responsible_email,
            'mobile' => $this->mobile,
            'motive' => $this->motive,
            'has_disability' => $this->has_disability,
            'disabilities' => $this->disabilities,
            'capacity_id' => $this->capacity_id,
            'created_by_id' => $this->user_id,
        ];

        // Disable global scopes to find the building_id
        SectorModel::disableGlobalScopes();
        $data['building_id'] = SectorModel::find($this->sector_modal_id)->building_id;
        SectorModel::enableGlobalScopes();

        $person = [
            'full_name' => $this->full_name,
            'social_name' => $this->social_name,
            'document_type_id' => $this->document_type_id,
            'document_number' => $this->document_number,
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'other_city' => $this->other_city,
            'email' => $this->responsible_email,
            'mobile' => $this->mobile,
            'has_disability' => $this->has_disability,
            'disabilities' => $this->disabilities
        ];

        $data = array_merge($data, [
            'reservation_type_id' => '1',
            'code' => generate_code(),
            'reservation_status_id' => '1',
            'person' => json_encode($person),
        ]);

        app(ReservationRepository::class)->create($data);

        $this->dispatchBrowserEvent('hide-modal', ['target' => 'reservation-modal']);
        $this->emit('associated-sector-user', $this->sector_modal_id);
        $this->cleanModal();
        $this->swallSuccess('Novo Agendamento Adicionado com Sucesso.');
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

    public function mount()
    {
        $this->sectors = app(Sectors::class)->allForUser();
    }

    public function loadDates()
    {
        if (!empty($this->sector_modal_id)) {
            $dates = BlockedDate::where('sector_id', $this->sector_modal_id)->pluck('date');

            //Array map, para sábados e domingos, holiday date (cadastrar
            //No final do ano faltando X dias para virar o ano, faz o processamento da holiday do próximo ano.
            //Array remove/reduce de exception date.
            //Cadastrar uma tabela de exceções.

            $this->blockedDates = $dates->map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('d/m/Y');
            });
        } else {
            $this->blockedDates = [];

        }
    }

    public function editReservation($reservationId)
    {
        $this->cleanModal();
        $this->fill($reservationId);
        $this->dispatchBrowserEvent('show-modal', ['target' => 'reservation-modal']);
    }

    public function fill($reservationId)
    {
        $reservation = Reservation::find($reservationId);
        if ($reservation) {
            $person = json_decode($reservation->person, true);
            $this->user_id = $reservation->user_id;
            $this->sector_modal_id = $reservation->sector_id;
            $this->motive = $reservation->motive;
            $this->reservation_date = Carbon::parse($reservation->reservation_date)->format('d/m/Y');
            $this->updatedReservationDate($this->reservation_date);
            $this->full_name = $person['full_name'] ?? $this->full_name;;
            $this->social_name = $person['social_name'] ?? $this->social_name;
            $this->document_type_id = $person['document_type_id'] ?? $this->document_type_id;
            $this->document_number = $person['document_number'] ?? $this->document_number;
            $this->country_id = $person['country_id'] ?? $this->country_id;
            $this->state_id = $person['state_id'] ?? $this->state_id;
            $this->city_id = $person['city_id'] ?? $this->city_id;
            $this->other_city = $person['other_city'] ?? $this->other_city;
            $this->responsible_email = $person['email'] ?? $this->responsible_email;
            $this->confirm_email = $person['email'] ?? $this->responsible_email;
            $this->mobile = $person['mobile'] ?? $this->mobile;
            $this->has_disability = $person['has_disability'] ?? $this->has_disability;
            $this->disabilities = $person['disabilities'] ?? $this->disabilities;
            $this->capacity_id = $reservation->capacity_id;
        }
    }

    public function updatedSectorModalId()
    {
        $this->reset('reservation_date', 'capacity_id', 'capacities');

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
        if (!empty($this->sector_modal_id) && !empty($this->reservation_date)) {

            $date = \DateTime::createFromFormat('d/m/Y', $this->reservation_date)->format('Y-m-d');
            $this->capacities = \DB::table('capacities as c')
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
        } else {
            $this->capacities = [];
        }
    }


    public function loadDefault()
    {
        if (is_null($this->document_type_id)) {
            $this->document_type_id = config('app.document_type_cpf');
        }

        $this->loadDefaultLocation();

    }
}
