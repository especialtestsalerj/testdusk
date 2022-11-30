<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Visitors as VisitorsRepository;
use App\Data\Repositories\Sectors as SectorsRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Data\Repositories\People as PeopleRepository;
use App\Http\Requests\VisitorStore as VisitorRequest;
use App\Http\Requests\VisitorUpdate as VisitorUpdateRequest;
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

        $routine = app(RoutinesRepository::class)->findById($routine_id);

        return $this->view('visitors.form')->with([
            'routine_id' => $routine_id,
            'routine' => $routine,
            'visitor' => app(VisitorsRepository::class)->new(),
            'people' => app(PeopleRepository::class)->all(),
            'sectors' => app(SectorsRepository::class)
                ->disablePagination()
                ->all(),
            'users' => app(UsersRepository::class)->all(),
        ]);
    }

    public function store(VisitorRequest $request)
    {
        $person = app(PeopleRepository::class)->createOrUpdateFromRequest($request->all());

        $request->merge(['person_id' => $person->id]);

        $visitor = app(VisitorsRepository::class)->create($request->all());

        return redirect()
            ->route('routines.show', $visitor->routine_id)
            ->with('status', 'Visitante adicionado com sucesso!');
    }

    public function show($id)
    {
        formMode(Constants::FORM_MODE_SHOW);

        $visitor = app(VisitorsRepository::class)->findById($id);
        $routine = app(RoutinesRepository::class)->findById($visitor->routine_id);

        return $this->view('visitors.form')->with([
            'routine_id' => $visitor->routine_id,
            'visitor' => $visitor,
            'routine' => $routine,
            'people' => app(PeopleRepository::class)->all(),
            'sectors' => app(SectorsRepository::class)->all(),
            'users' => app(UsersRepository::class)->all(),
        ]);
    }

    public function update(VisitorUpdateRequest $request, $id)
    {
        $person = app(PeopleRepository::class)->createOrUpdateFromRequest($request->all());

        $request->merge(['person_id' => $person->id]);

        $visitor = app(VisitorsRepository::class)->update($id, $request->all());

        return redirect()
            ->route('routines.show', $visitor->routine_id)
            ->with('status', 'Visitante alterado com sucesso!');
    }
}
