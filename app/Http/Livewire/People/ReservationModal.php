<?php

namespace App\Http\Livewire\People;

use App\Models\Person as PersonModel;
use Livewire\Component;
use App\Models\Person;

class ReservationModal extends Component
{
    protected $listeners = [
        'loadPersonReservations',
    ];
    public $personId;
    public $reservations = [];
    public $selectedReservations = [];
    public $personName;
    public $person;
    public $document_id;

    public function loadPersonReservations($personId, $document_id)
    {
        $this->personId = $personId;
        $this->document_id = $document_id;
        $today = now()->toDateString();
        $this->person = PersonModel::where('people.id', $personId)->whereHas('reservationsAsResponsible', function($query) use ($today) {
            $query->whereDate('reservation_date', $today)->where('reservation_status_id', 2)
                ->where('building_id', get_current_building()->id);

        })->with(['reservationsAsResponsible' => function ($query) use ($today) {
            $query->whereDate('reservation_date', $today)
                ->where('building_id', get_current_building()->id);
        }])
            ->first();


        // Carrega todas as reservas dessa pessoa
        $this->reservations = $this->person->reservationsAsResponsible;

        $this->personName = $this->person->name;

        // Abre o modal
        $this->dispatchBrowserEvent('show-modal', ['target' => 'reservationModal']);
    }

    public function render()
    {
        return view('livewire.people.reservation-modal');
    }

    public function clearModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('hide-modal', ['target' => 'reservationModal']);
    }

    public function confirmSelectedEntries()
    {
        return redirect()->route('visitors.create', ['document_id' =>'','reservation_id'=>[$this->selectedReservations]]);
    }
}
