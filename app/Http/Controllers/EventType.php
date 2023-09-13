<?php

namespace App\Http\Controllers;
use App\Data\Repositories\EventTypes as EventTypesRepository;
use App\Http\Requests\EventTypeStore;
use App\Http\Requests\EventTypeUpdate;
use App\Http\Requests\EventTypeDestroy;
use App\Support\Constants;

class EventType extends Controller
{
    public function create()
    {
        formMode(Constants::FORM_MODE_CREATE);

        return $this->view('event-types.form')->with([
            'eventType' => app(EventTypesRepository::class)->new(),
        ]);
    }

    public function store(EventTypeStore $request)
    {
        app(EventTypesRepository::class)->create($request->all());

        return redirect()
            ->route('event-types.index')
            ->with('message', 'Tipo de Ocorrência adicionado com sucesso!');
    }

    public function show($id)
    {
        formMode(Constants::FORM_MODE_SHOW);

        return $this->view('event-types.form')->with([
            'eventType' => app(EventTypesRepository::class)->findById($id),
        ]);
    }

    public function update(EventTypeUpdate $request, $id)
    {
        app(EventTypesRepository::class)->update($id, $request->all());

        return redirect()
            ->route('event-types.index')
            ->with('message', 'Tipo de Ocorrência alterado com sucesso!');
    }

    public function destroy(EventTypeDestroy $request, $id)
    {
        $eventType = app(EventTypesRepository::class)->findById($id);

        $eventType->delete($id);

        return redirect()
            ->route('event-types.index')
            ->with('message', 'Tipo de Ocorrência removido com sucesso!');
    }
}
