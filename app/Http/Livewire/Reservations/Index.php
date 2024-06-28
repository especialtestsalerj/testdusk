<?php

namespace App\Http\Livewire\Reservations;

use App\Data\Repositories\Reservations as ReservationRepository;
use App\Data\Repositories\Sectors;
use App\Http\Livewire\BaseIndex;
use App\Models\Reservation;
use App\Models\ReservationStatus;
use Carbon\Carbon;

class Index extends BaseIndex
{

    protected $repository = ReservationRepository::class;

    public $orderByField = ['reservation_date', 'created_at'];
    public $orderByDirection = ['asc'];
    public $paginationEnabled = true;
    public $countResults;

    public Reservation $selectedReservation;

    public $searchFields = [
        'people.full_name' => 'text',
        'people.social_name' => 'text',
    ];

    protected $listeners = [
        'confirm-reservation' => 'confirmReservation',
        'cancel-reservation' => 'cancelReservation',
        'store-contact' => '$refresh',
    ];

    public $sector_id;

    protected $reservations;


    public function render()
    {
        return view('livewire.reservations.index')->with($this->getComponentVariables());
    }

    public function mount()
    {


    }

    public function prepareForConfirmReservation($id)
    {

        $this->selectedReservation = Reservation::where('id',$id)->first();

        $reservationDate = Carbon::parse($this->selectedReservation['reservation_date'])->format('d/m/Y');
        $this->emitSwall('Confirmar a reserva?','Deseja Realmente confirmar a solicitação de '.json_decode($this->selectedReservation['person'])->full_name .
         '  para '. $reservationDate . ' às '. $this->selectedReservation->capacity->hour
              ,'confirm-reservation', 'save');

        $this->loadReservations();

    }

    public function prepareForCancelReservation($id)
    {
        $this->selectedReservation = Reservation::where('id',$id)->first();

        $reservationDate = Carbon::parse($this->selectedReservation['reservation_date'])->format('d/m/Y');
        $this->emitSwall('Deseja Realmente cancelar a solicitação de '.json_decode($this->selectedReservation['person'])->full_name .
            '  para '. $reservationDate . ' às '. $this->selectedReservation->capacity->hour,
            'Esta ação não poderá ser cancelada.','cancel-reservation', 'save');

        $this->loadReservations();

    }

    public function prepareForChangeDate($id)
    {
        $this->selectedReservation = Reservation::where('id',$id)->first();


        $this->swalInput('Teste','text');
        $this->loadReservations();

    }

    public function confirmReservation()
    {

        $this->selectedReservation->reservation_status_id = ReservationStatus::where('name', 'VISITA AGENDADA')->first()->id;
        $this->selectedReservation->save();
        $this->loadReservations();
    }

    public function cancelReservation()
    {

        $this->selectedReservation->reservation_status_id = ReservationStatus::where('name', 'VISITA CANCELADA')->first()->id;
        $this->selectedReservation->save();
        $this->loadReservations();
    }

    protected function getComponentVariables()
    {

        return ['sectors' =>app(Sectors::class)->allForUser()];
    }


    public function updatedSectorId()
    {

        $this->loadReservations();
    }

    public function loadReservations()
    {

        if(!empty($this->sector_id)){
            $this->reservations = $this->filter();
        }
    }

    public function additionalFilterQuery($query){

        return $query->where('sector_id', $this->sector_id);

    }
}
