<?php

namespace App\Http\Livewire\People;

use App\Data\Repositories\People as PeopleRepository;

use App\Http\Livewire\BaseIndex;
use App\Http\Livewire\Traits\Checkoutable;
use Livewire\Component;

class Index extends BaseIndex
{
    use Checkoutable;

    protected $repository = PeopleRepository::class;

    public $orderByField = ['full_name', 'created_at'];
    public $orderByDirection = ['asc'];
    public $paginationEnabled = true;

    public $searchFields = [
        'people.full_name' => 'text',
        'people.social_name' => 'text',
    ];

    protected $listeners = [
        'confirm-checkout-visitor' => 'confirmCheckout',
    ];
    public function additionalFilterQuery($query)
    {

        //dump($this->searchString);

        if (!is_null($this->searchString) && $this->searchString != '') {
            //busca na tabela de documentos
            $query = $query->orWhereRaw(
                "people.id in (select person_id from documents d
             where d.number ILIKE '%'||unaccent('" .
                pg_escape_string($this->searchString) .
                "')||'%' )"
            );
        }

        $query = $query->with('pendingVisit');

        return $query;
    }

    public function render()
    {
        return view('livewire.people.index')->with('people', $this->filter());
    }
}
