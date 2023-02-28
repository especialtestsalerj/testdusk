<?php

namespace App\Http\Controllers;
use App\Http\Requests\EventTypeStore as EventTypeRequest;
use App\Data\Repositories\EventTypes as EventTypesRepository;
use App\Http\Requests\EventTypeUpdate as EventTypeUpdateRequest;
use App\Http\Requests\EventTypeDelete as EventTypeDeleteRequest;
use App\Support\Constants;

class EventType extends Controller
{
    public function index()
    {
        return $this->view('event-types.index')->with(
            'eventTypes',
            app(EventTypesRepository::class)
                ->disablePagination()
                ->all()
        );
    }

    public function create()
    {
        formMode(Constants::FORM_MODE_CREATE);

        return $this->view('event-types.form')->with([
            'eventType' => app(EventTypesRepository::class)->new(),
        ]);
    }

    public function store(EventTypeRequest $request)
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

    public function update(EventTypeUpdateRequest $request, $id)
    {
        app(EventTypesRepository::class)->update($id, $request->all());

        return redirect()
            ->route('event-types.index')
            ->with('message', 'Tipo de Ocorrência alterado com sucesso!');
    }

    public function delete(EventTypeDeleteRequest $request, $id)
    {
        $eventType = app(EventTypesRepository::class)->findById($id);

        $eventType->delete($id);

        return redirect()
            ->route('event-types.index')
            ->with('message', 'Tipo de Ocorrência removido com sucesso!');
    }
}
