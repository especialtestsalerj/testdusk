<?php

namespace App\Http\Livewire\Reservation;

use App\Models\Reservation;
use Asantibanez\LivewireCalendar\LivewireCalendar;
use Carbon\Carbon;
use Illuminate\Support\Collection as Collection;
use Livewire\Component;

class AppointmentsCalendar extends LivewireCalendar
{


    public function events(): Collection
    {
        return $this->transformReservations(Reservation::with('capacity')->join('capacities',
            'reservations.capacity_id','=','capacities.id')
            ->orderBy('reservation_date')->orderBy('capacities.hour')->get());
    }

    private function transformReservations($reservations)
    {
        $collection = collect();
        foreach($reservations as $reservation){
            $collection->add(

                    [
                        'id' => $reservation->id,
                        'title' => $reservation->hour . ': Reserva de ' . json_decode($reservation->person)->full_name,
                        'description' => 'Setor: '. $reservation?->sector?->name,
                        'date' => $reservation->reservation_date,
                        ]
            );
        }
        return $collection;
    }
}


