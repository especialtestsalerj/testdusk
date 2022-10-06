<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Shifts as ShiftsRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Http\Requests\RoutineFinish;
use App\Http\Requests\RoutineStore as RoutineRequest;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Http\Requests\RoutineUpdate as RoutineUpdateRequest;
use App\Support\Constants;

class Routine extends Controller
{
    public function index()
    {
        return $this->view('routines.index')->with(
            'routines',
            app(RoutinesRepository::class)->all()
        );
    }

    public function create()
    {
        if (app(RoutinesRepository::class)->hasRoutineOpened()) {
            return redirect()
                ->route('routines.index')
                ->withErrors(['Existe alguma rotina em aberto.']);
        }

        formMode(Constants::FORM_MODE_CREATE);
        $routine = app(RoutinesRepository::class)->new();
        $routine->status = true;
        return $this->view('routines.form')->with([
            'routine' => $routine,
            'shifts' => app(ShiftsRepository::class)->all('name'),
            'entrancedUsers' => app(UsersRepository::class)->all('name'),
            'exitedUsers' => app(UsersRepository::class)->all('name'),
        ]);
    }

    public function store(RoutineRequest $request)
    {
        app(RoutinesRepository::class)->create($request->all());

        return redirect()
            ->route('routines.index')
            ->with('status', 'Rotina adicionada com sucesso!');
    }

    public function show($id)
    {
        formMode(Constants::FORM_MODE_SHOW);

        return $this->view('routines.form')->with([
            'routine' => app(RoutinesRepository::class)->findById($id),
            'shifts' => app(ShiftsRepository::class)->all('name'),
            'entrancedUsers' => app(UsersRepository::class)->all('name'),
            'exitedUsers' => app(UsersRepository::class)->all('name'),
        ]);
    }

    public function update(RoutineUpdateRequest $request, $id)
    {
        app(RoutinesRepository::class)->update($id, $request->all());

        return redirect()
            ->route('routines.index')
            ->with('status', 'Rotina alterada com sucesso!');
    }

    public function finish(RoutineFinish $request, $id)
    {
        $request->merge(['status' => false]);
        app(RoutinesRepository::class)->update($id, $request->all());

        return redirect()
            ->route('routines.index')
            ->with('status', 'Rotina finalizada com sucesso!');
    }
}
