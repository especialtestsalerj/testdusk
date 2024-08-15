<?php

namespace App\Http\Livewire\People;

use App\Data\Repositories\DocumentTypes;
use App\Data\Repositories\People as PeopleRepository;

use App\Data\Repositories\Reservations;
use App\Http\Livewire\BaseIndex;
use App\Http\Livewire\Traits\Badgeable;
use App\Http\Livewire\Traits\ChangeViewType;
use App\Http\Livewire\Traits\Checkoutable;
use App\Models\Reservation;
use Carbon\Carbon;
use Livewire\Component;

class Index extends BaseIndex
{
    use Checkoutable, Badgeable, ChangeViewType;

    protected $repository = PeopleRepository::class;
    protected $queryWith = ['documents.documentType'];
    public $orderByField = ['full_name', 'created_at'];
    public $orderByDirection = ['asc'];
    public $paginationEnabled = true;
    public $countResults;

    public $searchFields = [
        'people.full_name' => 'text',
        'people.social_name' => 'text',
    ];

    protected $listeners = [
        'confirm-checkout-visitor' => 'confirmCheckout',
    ];

    public $reservations;
    public $reservationGroup;

    public function getSearchStringIsCpfProperty()
    {
        return !!validate_cpf($this->searchString);
    }

    public function getSearchStringDocumentTypeProperty()
    {
        return !!validate_cpf($this->searchString)
            ? app(DocumentTypes::class)->getById(config('app.document_type_cpf'))
            : '';
    }

    public function additionalFilterQuery($query)
    {
        //dump($this->searchString);

        if (!is_null($this->searchString) && $this->searchString != '') {
            //busca na tabela de documentos
            $query = $query->orWhereRaw(
                "people.id in (select person_id from documents d
             where regexp_replace(d.number, '[^a-zA-Z0-9]', '', 'g') ILIKE '%'||unaccent('" .
                    pg_escape_string(remove_punctuation($this->searchString)) .
                    "')||'%' )"
            );
        }

        $query = $query->with('pendingVisit');

        $this->countResults =  $query->count();

        $this->loadReservations();

        return $query;
    }

    public function render()
    {
        return view('livewire.people.index')->with(['people' => $this->filter(),'reservations'=>$this->reservations, 'countPeople' => $this->countResults]);
    }

    public function redirectToVisitorsForm()
    {
        $this->swalConfirmation(
            'ATENÇÃO',
            'Você realmente não encontrou a pessoa pesquisada?',
            route('visitors.create',
                $this->getSearchStringIsCpfProperty() ?
                    ['document_type_id'=>$this->getSearchStringDocumentTypeProperty()[0]->id, 'document_number'=>$this->searchString]
                    : ['full_name'=>$this->searchString]
            )
        );
    }

    private function loadReservations()
    {
        $today = Carbon::today()->toDateString();

        // Busca reservas cuja data corresponde a hoje
        $this->reservations = Reservation::where('reservation_status_id', 2)->whereDate('reservation_date', $today)->get();

        //Buscar reservas com a data de hj onde os convidados ainda não chegaram

        $this->reservationGroup = Reservation::join('reservation_person', 'reservations.id', '=', 'reservation_person.reservation_id')->whereDate('reservation_date', $today)->
            where('reservation_person.reservation_status_id',2)->get();


    }
}
