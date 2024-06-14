<?php

namespace App\Http\Livewire\Reservations;

use App\Data\Repositories\Reservations as ReservationRepository;
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


    public function render()
    {
        return view('livewire.reservations.index')->with(['reservations' => $this->filter()]);
    }

    public function mount()
    {


    }

    public function prepareForConfirmReservation($reservation)
    {
        $this->selectedReservation = Reservation::where('id',$reservation['id'])->first();

        $reservationDate = Carbon::parse($reservation['reservation_date'])->format('d/m/Y');
        $this->emitSwall('Deseja Realmente confirmar a solicitação de '.json_decode($reservation['person'])->full_name .
         '  para '. $reservationDate . ' às '. $reservation['capacity']['hour'],
              'Esta ação não poderá ser cancelada.','confirm-reservation', 'save');

    }

    public function prepareForCancelReservation($reservation)
    {
        $this->selectedReservation = Reservation::where('id',$reservation['id'])->first();

        $reservationDate = Carbon::parse($reservation['reservation_date'])->format('d/m/Y');
        $this->emitSwall('Deseja Realmente cancelar a solicitação de '.json_decode($reservation['person'])->full_name .
            '  para '. $reservationDate . ' às '. $reservation['capacity']['hour'],
            'Esta ação não poderá ser cancelada.','cancel-reservation', 'save');

    }

    public function prepareForChangeDate($reservation)
    {
        $this->selectedReservation = Reservation::where('id',$reservation['id'])->first();


        $this->swalInput('Teste','text');

    }

    public function confirmReservation()
    {

        $this->selectedReservation->reservation_status_id = ReservationStatus::where('name', 'VISITA AGENDADA')->first()->id;
        $this->selectedReservation->save();
    }

    public function cancelReservation()
    {

        $this->selectedReservation->reservation_status_id = ReservationStatus::where('name', 'VISITA CANCELADA')->first()->id;
        $this->selectedReservation->save();
    }
}
