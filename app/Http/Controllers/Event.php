<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Events as EventsRepository;
use App\Data\Repositories\EventTypes as EventTypesRepository;
use App\Data\Repositories\Sectors as SectorsRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Http\Requests\EventStore as EventRequest;
use App\Http\Requests\EventUpdate as EventUpdateRequest;
use App\Http\Requests\EventDelete as EventDeleteRequest;
use App\Support\Constants;

class Event extends Controller
{
    public function create($routine_id)
    {
        formMode(Constants::FORM_MODE_CREATE);

        $routine = app(RoutinesRepository::class)->findById([$routine_id]);

        return $this->view('events.form')->with([
            'routine_id' => $routine_id,
            'routine' => $routine,
            'event' => app(EventsRepository::class)->new(),
            'eventTypes' => app(EventTypesRepository::class)
                ->disablePagination()
                ->all(),
            'sectors' => app(SectorsRepository::class)
                ->disablePagination()
                ->all(),
            'users' => app(UsersRepository::class)
                ->disablePagination()
                ->all(),
        ]);
    }

    public function createFromDashboard($routine_id)
    {
        formMode(Constants::FORM_MODE_CREATE);

        $routine = app(RoutinesRepository::class)->findById([$routine_id]);

        return $this->view('events.form-dashboard')->with([
            'routine_id' => $routine_id,
            'routine' => $routine,
            'event' => app(EventsRepository::class)->new(),
            'eventTypes' => app(EventTypesRepository::class)
                ->disablePagination()
                ->all(),
            'sectors' => app(SectorsRepository::class)
                ->disablePagination()
                ->all(),
            'users' => app(UsersRepository::class)
                ->disablePagination()
                ->all(),
        ]);
    }

    public function store(EventRequest $request)
    {
        $event = app(EventsRepository::class)->create($request->all());
        //->route('routines.show', $event->routine_id)
        return redirect()
            ->route($request['redirect'], $event->routine_id)
            ->with('message', 'Ocorrência adicionada com sucesso!');
    }

    public function storeFromDashboard(EventRequest $request)
    {
        $event = app(EventsRepository::class)->create($request->all());

        return redirect()
            ->route('events.index', $event->routine_id)
            ->with('message', 'Ocorrência adicionada com sucesso!');
    }

    public function show($id)
    {
        formMode(Constants::FORM_MODE_SHOW);

        $event = app(EventsRepository::class)->findById($id);
        $routine = app(RoutinesRepository::class)->findById($event->routine_id);

        return $this->view('events.form')->with([
            'routine_id' => $event->routine_id,
            'routine' => $routine,
            'event' => $event,
            'eventTypes' => app(EventTypesRepository::class)
                ->disablePagination()
                ->all(),
            'sectors' => app(SectorsRepository::class)
                ->disablePagination()
                ->all(),
            'users' => app(UsersRepository::class)
                ->disablePagination()
                ->all(),
        ]);
    }

    public function showFromDashboard($routine_id, $id)
    {
        formMode(Constants::FORM_MODE_SHOW);

        $event = app(EventsRepository::class)->findById($id);
        $routine = app(RoutinesRepository::class)->findById($routine_id);

        return $this->view('events.form-dashboard')->with([
            'routine_id' => $routine_id,
            'routine' => $routine,
            'event' => $event,
            'eventTypes' => app(EventTypesRepository::class)
                ->disablePagination()
                ->all(),
            'sectors' => app(SectorsRepository::class)
                ->disablePagination()
                ->all(),
            'users' => app(UsersRepository::class)
                ->disablePagination()
                ->all(),
        ]);
    }

    public function update(EventUpdateRequest $request, $id)
    {
        $event = app(EventsRepository::class)->update($id, $request->all());
        //->route('routines.show', $event->routine_id)
        return redirect()
            ->route($request['redirect'], $event->routine_id)
            ->with('message', 'Ocorrência alterada com sucesso!');
    }

    public function updateFromDashboard(EventUpdateRequest $request, $routine_id, $id)
    {
        $event = app(EventsRepository::class)->update($id, $request->all());

        return redirect()
            ->route('events.index', $routine_id)
            ->with('message', 'Ocorrência alterada com sucesso!');
    }

    public function delete(EventDeleteRequest $request, $id)
    {
        $event = app(EventsRepository::class)->findById($id);

        $event->delete($id);
        //->route('routines.show', $event->routine_id)
        return redirect()
            ->route($request['redirect'], $event->routine_id)
            ->with('message', 'Ocorrência removida com sucesso!');
    }

    public function deleteFromDashboard($id)
    {
        $event = app(EventsRepository::class)->findById($id);

        $event->delete($id);

        return redirect()
            ->route('events.index', $event->routine_id)
            ->with('message', 'Ocorrência removida com sucesso!');
    }
}
