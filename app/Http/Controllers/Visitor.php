<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Visitors as VisitorsRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\People as PeopleRepository;
use App\Http\Requests\VisitorStore as VisitorRequest;
use App\Http\Requests\VisitorUpdate as VisitorUpdateRequest;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Support\Constants;

class Visitor extends Controller
{
    public function index()
    {
        return $this->view('visitors.index')->with(
            'visitors',
            app(VisitorsRepository::class)->all()
        );
    }

    public function create($routine_id)
    {
        formMode(Constants::FORM_MODE_CREATE);

        return $this->view('visitors.form')->with([
            'routine_id' => $routine_id,
            'visitor' => app(VisitorsRepository::class)->new(),
            'users' => app(UsersRepository::class)->all('name'),
            'people' => app(PeopleRepository::class)->all('name'),
        ]);
    }

    public function store(VisitorRequest $request)
    {
        $visitor = app(VisitorsRepository::class)->create($request->all());

        return redirect()->route('routines.show', $visitor->routine_id);
    }

    public function show($id)
    {
        $visitor = app(VisitorsRepository::class)->findById($id);
        return $this->view('visitors.form')->with([
            'routine_id' => $visitor->routine_id,
            'visitor' => $visitor,
            'users' => app(UsersRepository::class)->all('name'),
            'people' => app(PeopleRepository::class)->all('name'),
        ]);
    }

    public function update(VisitorUpdateRequest $request, $id)
    {
        $visitor = app(VisitorsRepository::class)->create($request->all());
        app(VisitorsRepository::class)->update($id, $request->all());

        return redirect()->route('routines.show', $visitor->routine_id);
    }
}