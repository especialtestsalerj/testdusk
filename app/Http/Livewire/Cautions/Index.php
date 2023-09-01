<?php

namespace App\Http\Livewire\Cautions;

use App\Data\Repositories\Cautions as CautionsRepository;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Http\Livewire\BaseIndex;
use App\Http\Livewire\Traits\CautionReceipt;

class Index extends BaseIndex
{
    use CautionReceipt;
    
    protected $repository = CautionsRepository::class;

    public $orderByField = ['protocol_number'];
    public $orderByDirection = [];
    public $paginationEnabled = true;
    public $routine_id;
    public $routine;
    public $redirect;

    public $searchFields = [
        'cautions.protocol_number' => 'protocol_number',
        'cautions.started_at' => 'date',
    ];

    public function mount()
    {
        $this->routine = app(RoutinesRepository::class)->findById([$this->routine_id]);
    }

    public function additionalFilterQuery($query)
    {
        if (!is_null($this->searchString) && $this->searchString != '') {
            $query = $query->WhereRaw(
                "cautions.visitor_id in (select v.id from visitors v inner join people p on v.person_id = p.id
                                         where p.full_name ILIKE '%'||unaccent('" .
                    pg_escape_string($this->searchString) .
                    "')||'%'
                                        or p.social_name ILIKE '%'||unaccent('" .
                    pg_escape_string($this->searchString) .
                    "')||'%' )"
            );
        }

        return $query->where('routine_id', $this->routine_id);
    }

    public function render()
    {
        return view('livewire.cautions.index')->with(['cautions' => $this->filter()]);
    }
}
