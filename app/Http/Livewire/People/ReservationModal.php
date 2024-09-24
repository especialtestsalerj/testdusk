<?php

namespace App\Http\Livewire\People;

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

    public function loadPersonReservations($personId)
    {
        $this->personId = $personId;
        $person = Person::with('reservations')->findOrFail($personId);

        // Carrega todas as reservas dessa pessoa
        $this->reservations = $person->reservations->sortByDesc('reservation_date');
        $this->personName = $person->name;

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
        dd($this->selectedReservations, 'continuar....');
    }
}
