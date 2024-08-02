<?php

namespace App\Http\Livewire\Reservations;

use App\Data\Repositories\People;
use App\Data\Repositories\People as PeopleRepository;
use App\Data\Repositories\Reservations as ReservationRepository;
use App\Data\Repositories\Sectors;
use App\Http\Livewire\BaseIndex;
use App\Models\Document;
use App\Models\Reservation;
use App\Models\ReservationStatus;
use Carbon\Carbon;

class Index extends BaseIndex
{

    protected $repository = ReservationRepository::class;
    protected $model = Reservation::class;

    public $orderByField = ['reservation_date'];
    public $orderByDirection = ['desc'];
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
            'sectors' => app(Sectors::class)->allForUser(),
            'statuses' => ReservationStatus::all(),
            'countReservations' => $this->countResults,
        ]);
    }

    public function mount()
    {
        $this->startDate = now()->format('Y-m-d');
    }

    public function additionalFilterQuery($query)
    {
        $query = $this->filterDates($query);
        $query = $this->filterStatus($query);

        return $query->where('sector.id', $this->sector_id);
    }


    public function filterDates($query)
    {
        if ($this->startDate != null) {
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

        $personArray = json_decode($this->selectedReservation->person,true);
        $document = Document::where('number', remove_punctuation($personArray['document_number']) )->first();

        if(is_null($document?->person_id)){


        $person = app(PeopleRepository::class)->createOrUpdateFromRequest($personArray['name']);
        $document = Document::firstOrCreate([
            'number' => convert_case(
                remove_punctuation($personArray['document_number']),
                MB_CASE_UPPER)],
            [
            'person_id' => $person->id,
            'document_type_id' =>$personArray['document_type_id'],
            ]);
        $this->selectedReservation->person_id = $person->id;

        }else{
            $this->selectedReservation->person_id = $document->person_id;
        }


        if($this->selectedReservation->quantity > 1){
            $guests = json_decode($this->selectedReservation->guests,true);

            foreach($guests as $guest){
                $document = Document::where('number', remove_punctuation($guest['document']) )->first();
                if(is_null($document?->person_id)){


                    $person = app(PeopleRepository::class)->createOrUpdateFromRequest(['full_name'=>$guest['name']]);
                    $document = Document::firstOrCreate([
                        'number' => convert_case(
                            remove_punctuation($guest['document']),
                            MB_CASE_UPPER)],
                        [
                            'person_id' => $person->id,
                            'document_type_id' =>$guest['documentType'],
                        ]);
                    $this->selectedReservation->guests()->attach($person->id);

                }else{
                    $this->selectedReservation->guests()->attach($document->person_id);
                }
            }



        }
        $this->selectedReservation->confirmed_at = Carbon::now();
        $this->selectedReservation->confirmed_by_id = auth()->user()->id;
        $this->selectedReservation->save();
    }

    public function cancelReservation()
    {
        $this->selectedReservation->reservation_status_id = ReservationStatus::where('name', 'VISITA CANCELADA')->first()->id;
        $this->selectedReservation->canceled_at = Carbon::now();
        $this->selectedReservation->canceled_by_id = auth()->user()->id;
        $this->selectedReservation->save();
    }

    public function editReservation($reservationId)
    {
        $this->emit('editReservation', $reservationId);
    }

}
