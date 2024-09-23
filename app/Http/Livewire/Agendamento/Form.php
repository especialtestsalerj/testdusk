<?php

namespace App\Http\Livewire\Agendamento;

use App\Data\Repositories\Reservations as ReservationRepository;
use App\Http\Livewire\Reservations\Form as FormBase;
use App\Models\Sector as SectorModel;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class Form extends FormBase
{

    public $inputs = [];
    public function render()
    {


        $this->loadCountryBr();
        $this->loadDefaultLocation();

        return view('livewire.agendamento.form')->with($this->getViewVariables());
    }

    public function addInput()
    {
        $this->inputs[] = ['cpf' => '', 'name' => '','documentType'=>''];


    }

    public function removeInput($index)
    {
        unset($this->inputs[$index]);

        $this->inputs = array_values($this->inputs); // Reindexa o array
    }



    public function loadDates()
    {
//        dump('datas');
        parent::loadDates();
//        $this->emit('load');
    }


    public function save()
    {
        $requiresMotivation = $this->sector ? $this->sector->required_motivation : false;
        // Validações e lógica de salvamento aqui
        $this->validate([

//                    'building_id' =>        ['required'],
            'sector_id' =>          ['required'],
            'birthdate'=>           ['required'],
            'reservation_date' => ['required'],
            'capacity_id' =>       ['required'],
            'document_type_id' =>   ['required'],
            'document_number' =>    ['required'],
            'full_name' =>          ['required'],
//                    'social_name' =>        ['required'],
            'country_id' =>         ['required'],
            'state_id' =>           ['required'],
            'city_id' =>            ['required'],
//                    'other_city' =>         ['required'],
            'responsible_email' => ['required', 'email'],
            'confirm_email' => ['required', 'same:responsible_email'],
            'mobile' =>             ['required'],
            'motive' => [Rule::requiredIf($requiresMotivation),],
            'has_disability' =>['required'],
            'has_group' => ['required'],
            'institution' => ['required_if:has_group,true'],

        ]);



//            dd($this->reservation_date);
        $dataCarbon = Carbon::createFromFormat('d/m/Y', $this->reservation_date);

        $data = [
            'sector_id' => $this->sector_id,
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
        ];


        SectorModel::disableGlobalScopes();
        $data['building_id'] =SectorModel::find($this->sector_id)->building_id;
        SectorModel::enableGlobalScopes();



        $group = $this->inputs;

        $data['quantity'] = count($group) +1;


        $person = [
            'full_name' => $this->full_name,
            'social_name'=>$this->social_name,
            'document_type_id'=>$this->document_type_id,
            'document_number'=>$this->document_number,
            'country_id'=>$this->country_id,
            'state_id'=>$this->state_id,
            'city_id'=>$this->city_id,
            'other_city'=>$this->other_city,
            'email'=>$this->responsible_email,
            'mobile'=>$this->mobile,
            'has_disability'=>$this->has_disability,
            'disabilities'=>$this->disabilities,
            'birthdate'=>$this->birthdate,

        ];



        $data['guests'] = $this->inputs;

        $data = array_merge($data, ['reservation_type_id'=> '1', 'code'=>generate_code(), 'reservation_status_id'=> '1', 'person'=>$person, ]);

//        dd($data);

        $reservation = app(ReservationRepository::class)->create($data);

        // Lógica de salvamento
        // Exemplo:
        // Reservation::create([...]);

          return redirect()->route('agendamento.detail', ['uuid' => $reservation->uuid]);
    }
}
