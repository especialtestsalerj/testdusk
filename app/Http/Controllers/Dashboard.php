<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Routines as RoutinesRepository;

class Dashboard extends Controller
{
    public function index()
    {
        return $this->view('dashboard')->with(
            'routines',
            app(RoutinesRepository::class)
                ->disablePagination()
                ->allOrderBy('entranced_at', 'desc', 14)
        );
    }
}
