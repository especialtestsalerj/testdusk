<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Events as EventsRepository;
use App\Data\Repositories\EventTypes as EventTypesRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Http\Requests\EventStore as EventRequest;
use App\Http\Requests\EventUpdate as EventUpdateRequest;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Support\Constants;

class Event extends Controller
{
    public function index()
    {
        return $this->view('events.index')->with('events', app(EventsRepository::class)->all());
    }

    public function create($routine_id)
    {
        formMode(Constants::FORM_MODE_CREATE);

        return $this->view('events.form')->with([
            'routine_id' => $routine_id,
            'event' => app(EventsRepository::class)->new(),
            'eventTypes' => app(EventTypesRepository::class)->all('name'),
            'users' => app(UsersRepository::class)->all('name'),
        ]);
    }

    public function store(EventRequest $request)
    {
        $event = app(EventsRepository::class)->create($request->all());

        return redirect()->route('routines.show', $event->routine_id);
    }

    public function show($id)
    {
        $event = app(EventsRepository::class)->findById($id);
        return $this->view('events.form')->with([
            'routine_id' => $event->routine_id,
            'event' => $event,
            'eventTypes' => app(EventTypesRepository::class)->all('name'),
            'users' => app(UsersRepository::class)->all('name'),
        ]);
    }

    public function update(EventUpdateRequest $request, $id)
    {
        $event = app(EventsRepository::class)->create($request->all());
        app(EventsRepository::class)->update($id, $request->all());

        return redirect()->route('routines.show', $event->routine_id);
    }
}