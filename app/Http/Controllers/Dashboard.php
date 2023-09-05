<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Data\Repositories\Visitors as VisitorsRepository;

class Dashboard extends Controller
{
    public function index()
    {
        return $this->view('dashboard')->with([
            'pendingVisitors' => app(VisitorsRepository::class)->allPending(),
            'routines' => app(RoutinesRepository::class)
                ->disablePagination()
                ->allOrderBy('entranced_at', 'desc', 14),
        ]);
    }
}
