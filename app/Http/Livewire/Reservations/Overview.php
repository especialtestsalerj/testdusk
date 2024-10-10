<?php

namespace App\Http\Livewire\Reservations;

use App\Data\Repositories\Reservations as ReservationsRepository;
use App\Http\Livewire\BaseIndex;
use Livewire\Component;

class Overview extends BaseIndex
{

    protected $repository = ReservationsRepository::class;

    public $orderByField = ['reservation_date', 'created_at'];
    public $orderByDirection = ['asc'];
    public $paginationEnabled = true;
    public $countResults;

    public $searchFields = [
        'reservation.code' => 'text',
        'reservation.person' => 'text',
    ];
    public function render()
    {
        return view('livewire.reservations.overview')->with(['reservations' => $this->filter()]);
    }

    public function additionalFilterQuery($query){
        return $query->whereNot('reservation_status_id', 1)
            ->where('building_id', get_current_building()->id);
    }
}
