<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Data\Repositories\Visitors as VisitorsRepository;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class Session extends Controller
{
    public function changeCurrentBuilding(Request $request)
    {
        $buildingId = $request->get('session_building_id');
        session()->put('current_building', Building::findOrFail($buildingId));
        return Redirect::route('dashboard');
    }
}
