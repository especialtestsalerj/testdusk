<?php

namespace App\Http\Livewire\PersonRestrictions;

use App\Data\Repositories\PersonRestrictions as PersonRestrictionsRepository;
use App\Http\Livewire\BaseIndex;
use App\Models\Building;

class Index extends BaseIndex
{
    protected $repository = PersonRestrictionsRepository::class;

    public $orderByField = ['started_at', 'id'];
    public $orderByDirection = [];
    public $paginationEnabled = true;

    public $searchFields = [
        'person_restrictions.started_at' => 'date',
    ];

    public function additionalFilterQuery($query)
    {
        if (!is_null($this->searchString) && $this->searchString != '') {
            //Busca na tabela de people
            $query = $query->orWhereRaw(
                "person_restrictions.person_id in (select id from people p
             where p.full_name ILIKE '%'||unaccent('" .
                    pg_escape_string($this->searchString) .
                    "')||'%'
                                        or p.social_name ILIKE '%'||unaccent('" .
                    pg_escape_string($this->searchString) .
                    "')||'%' )"
            );
            //busca na tabela de documentos
            $query = $query->orWhereRaw(
                "person_restrictions.person_id in (select person_id from documents d
             where regexp_replace(d.number, '[^a-zA-Z0-9]', '', 'g') ILIKE '%'||unaccent('" .
                    pg_escape_string(remove_punctuation($this->searchString)) .
                    "')||'%')"
            );
        }
        return $query;
    }

    public function render()
    {
        return view('livewire.person-restrictions.index')->with([
            'personRestrictions' => $this->filter(),
            'buildings' => Building::all(),
        ]);
    }
}
