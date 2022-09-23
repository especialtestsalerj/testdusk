<?php

namespace App\Http\Controllers;
use App\Http\Requests\EventTypeStore as EventTypeRequest;
use App\Data\Repositories\EventTypes as EventTypesRepository;
use App\Http\Requests\EventTypeUpdate as EventTypeUpdateRequest;
use App\Support\Constants;

class EventType extends Controller
{
    public function index()
    {
        return $this->view('event_types.index')->with(
            'eventTypes',
            app(EventTypesRepository::class)->all()
        );
    }

    public function create()
    {
        formMode(Constants::FORM_MODE_CREATE);

        return $this->view('event_types.form')->with([
            'eventType' => app(EventTypesRepository::class)->new(),
        ]);
    }

    public function store(EventTypeRequest $request)
    {
        app(EventTypesRepository::class)->create($request->all());

        return redirect()
            ->route('event_types.index')
            ->with('status', 'Tipo de ocorrência adicionada com sucesso!');
    }

    public function show($id)
    {
        return $this->view('event_types.form')->with([
            'eventType' => app(EventTypesRepository::class)->findById($id),
        ]);
    }

    public function update(EventTypeUpdateRequest $request, $id)
    {
        formMode(Constants::FORM_MODE_SHOW);

        app(EventTypesRepository::class)->update($id, $request->all());

        return redirect()
            ->route('event_types.index')
            ->with('status', 'Tipo de ocorrência alterada com sucesso!');
    }
}
