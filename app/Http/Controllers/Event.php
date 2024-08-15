<?php

namespace App\Http\Controllers;

use App\Data\Repositories\AttachedFiles;
use App\Data\Repositories\Events as EventsRepository;
use App\Data\Repositories\EventTypes as EventTypesRepository;
use App\Data\Repositories\Sectors as SectorsRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Http\Requests\EventStore;
use App\Http\Requests\EventUpdate;
use App\Http\Requests\EventDestroy;
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
            'eventTypes' => app(EventTypesRepository::class)->allActive(),
            'sectors' => app(SectorsRepository::class)->allActive(),
            'users' => app(UsersRepository::class)
                ->disablePagination()
                ->all(),
        ]);
    }

    public function store(EventStore $request, $routine_id)
    {
        $event = app(EventsRepository::class)->create($request->all());

        if ($request->hasFile('files')) {
            $this->saveFiles($event, $request);
        }

        return redirect()
            ->route($request['redirect'], $routine_id)
            ->with('message', 'Ocorrência adicionada com sucesso!');
    }

    public function show($routine_id, $id)
    {
        formMode(Constants::FORM_MODE_SHOW);

        $event = app(EventsRepository::class)->findById($id);
        $routine = app(RoutinesRepository::class)->findById($routine_id);

        return $this->view('events.form')->with([
            'routine_id' => $routine_id,
            'routine' => $routine,
            'event' => $event,
            'eventTypes' => app(EventTypesRepository::class)->allActive($event?->eventType?->id),
            'sectors' => app(SectorsRepository::class)->allActive($event?->sector?->id),
            'users' => app(UsersRepository::class)
                ->disablePagination()
                ->all(),
        ]);
    }

    public function update(EventUpdate $request, $routine_id, $id)
    {
        $event = app(EventsRepository::class)->update($id, $request->all());

        if ($request->hasFile('files')) {
            $this->saveFiles($event, $request);
        }

        return redirect()
            ->route($request['redirect'], $routine_id)
            ->with('message', 'Ocorrência alterada com sucesso!');
    }

    protected function saveFiles($event, $request): void
    {
        $files = $request->get('files');

        if (is_array($files)) {
            foreach ($files as $file) {
                $originalName = $file->getClientOriginalName();
                $path = $file->store('documents');
                $storedFile = new \Illuminate\Http\UploadedFile(storage_path('app/' . $path), basename($path));
                app(AttachedFiles::class)->store($event, $storedFile, $originalName, false);
            }
        } else {
            $originalName = $files->getClientOriginalName();
            $path = $files->store('documents'); // Move o arquivo para a pasta 'documents' no armazenamento
            $storedFile = new \Illuminate\Http\UploadedFile(storage_path('app/' . $path), basename($path));
            app(AttachedFiles::class)->store($event, $storedFile, $originalName, false);
        }
    }

    public function destroy(EventDestroy $request, $routine_id, $id)
    {
        $event = app(EventsRepository::class)->findById($id);

        $event->delete($id);

        return redirect()
            ->route($request['redirect'], $routine_id)
            ->with('message', 'Ocorrência removida com sucesso!');
    }
}
