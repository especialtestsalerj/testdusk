<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as BaseRequest;
use App\Models\Visitor as VisitorModel;
class Visitor extends Controller
{
    public function openVisitors(BaseRequest $request)
    {
        $searchString = request()->query('q');
        $currentBuilding = request()->query('building_id');

        return VisitorModel::withoutGlobalScopes()
            ->when(
                $currentBuilding,
                fn($query) => $query->where('building_id', $currentBuilding['id'])
            )
            ->with(['person', 'document'])
            ->open()
            ->when(
                $searchString,
                fn($query) => $query->whereRaw(
                    "visitors.person_id in (select id from people p
             where p.full_name ILIKE '%'||unaccent('" .
                        pg_escape_string($searchString) .
                        "')||'%'
                                        or p.social_name ILIKE '%'||unaccent('" .
                        pg_escape_string($searchString) .
                        "')||'%' )"
                )
            )
            ->get()

            ->append(['photo', 'entranced_at_br_formatted'])
            ->map(function ($item) {
                $item->document->append('number_maskered');
                return $item;
            });
    }
}
