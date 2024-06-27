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
        return $this->transformReservations(Reservation::all());
    }

    private function transformReservations($reservations)
    {
        $collection = collect();
        foreach($reservations as $reservation){
            $collection->add(

                    [
                        'id' => $reservation->id,
                        'title' => 'Reserva de ' . json_decode($reservation->person)->full_name,
                        'description' => 'Setor: '. $reservation->sector?->name,
                        'date' => $reservation->reservation_date,
                        ]
            );
        }
        return $collection;
    }
}


