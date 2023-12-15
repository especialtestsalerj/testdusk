<?php

namespace App\Data\Repositories;

use App\Models\PersonRestriction;
use Illuminate\Support\Facades\DB;

class PersonRestrictions extends Repository
{
    /**
     * @var string
     */
    protected $model = PersonRestriction::class;

    public function getRestrictions($cpf)
    {
        return DB::table('person_restrictions')
            ->select('person_restrictions.message')
            ->join('documents', 'person_restrictions.person_id', '=', 'documents.person_id')
            ->where('documents.number', $cpf)
            ->where('person_restrictions.building_id', get_current_building()->id)
            ->whereRaw(
                "CURRENT_TIMESTAMP BETWEEN person_restrictions.started_at AND COALESCE(person_restrictions.ended_at, '9999-12-31 23:59:59')"
            )
            ->orderBy('person_restrictions.started_at', 'asc')
            ->orderBy('person_restrictions.ended_at', 'asc')
            ->orderBy('person_restrictions.id', 'asc')
            ->get();
    }
}
