<?php

namespace App\Http\Livewire\Reservations;

use App\Data\Repositories\Reservations as ReservationRepository;
use App\Data\Repositories\Sectors;
use App\Http\Livewire\BaseIndex;
use App\Models\Reservation;
use App\Models\ReservationStatus;
use Carbon\Carbon;
use Laravel\Scout\Builder;

class Index extends BaseIndex
{

    protected $repository = ReservationRepository::class;
    protected $model = Reservation::class;

    public $orderByField = ['reservation_date', 'created_at'];
    public $orderByDirection = ['asc'];
    public $paginationEnabled = true;
    public $countResults;
    public Reservation $selectedReservation;
    public $startDate;
    public $endDate;
    public $status_id;

    protected $queryString = [
        'searchString' => ['except' => ''],
        'page' => ['except' => 1],
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
        return view('livewire.reservations.index')->with([
            'reservations' => $this->fullTextFilter(),
            'sectors' => app(Sectors::class)->allVisitable(),
            'statuses' => ReservationStatus::all(),
            'countReservations' => $this->countResults,
        ]);
    }

    public function mount()
    {


    }

    public function additionalFilterQuery($query)
    {
        $query = $this->filterDates($query);
        $query = $this->filterStatus($query);

        return $query->where('sector.id', $this->sector_id);
    }


    public function filterDates($query)
    {
        if ($this->startDate) {
            $query->query(function ($query) {
                $query->where('reservation_date', '>=', $this->startDate);
            });
        }
        if ($this->endDate) {
            $query->query(function ($query) {
                $query->where('reservation_date', '<=', $this->endDate);
            });
        }

        return $query;
    }

    public function filterStatus($query)
    {
        if ($this->status_id) {
            $query->where('status.id', $this->status_id);
        }

        return $query;
    }

    public function prepareForConfirmReservation($id)
    {

        $this->selectedReservation = Reservation::where('id', $id)->first();

        $reservationDate = Carbon::parse($this->selectedReservation['reservation_date'])->format('d/m/Y');
        $this->emitSwall('Confirmar a reserva?', 'Deseja Realmente confirmar a solicitação de ' . json_decode($this->selectedReservation['person'])->full_name .
            '  para ' . $reservationDate . ' às ' . $this->selectedReservation->capacity->hour
            , 'confirm-reservation', 'save');
    }

    public function prepareForCancelReservation($id)
    {
        $this->selectedReservation = Reservation::where('id', $id)->first();

        $reservationDate = Carbon::parse($this->selectedReservation['reservation_date'])->format('d/m/Y');
        $this->emitSwall('Deseja Realmente cancelar a solicitação de ' . json_decode($this->selectedReservation['person'])->full_name .
            '  para ' . $reservationDate . ' às ' . $this->selectedReservation->capacity->hour,
            'Esta ação não poderá ser cancelada.', 'cancel-reservation', 'save');

    }

    public function prepareForChangeDate($id)
    {
        $this->selectedReservation = Reservation::where('id', $id)->first();
        $this->swalInput('Teste', 'text');

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
