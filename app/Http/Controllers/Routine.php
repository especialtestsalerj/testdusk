<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Shifts as ShiftsRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Http\Requests\RoutineStore as RoutineRequest;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Http\Requests\RoutineUpdate as RoutineUpdateRequest;
use App\Support\Constants;
use function Sodium\add;

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
        formMode(Constants::FORM_MODE_CREATE);

        return $this->view('routines.form')->with([
            'routine' => app(RoutinesRepository::class)->new(),
            'shifts' => app(ShiftsRepository::class)->all('name'),
            'entrancedUsers' => app(UsersRepository::class)->all('name'),
            'exitedUsers' => app(UsersRepository::class)->all('name'),
        ]);
    }

    public function store(RoutineRequest $request)
    {
        app(RoutinesRepository::class)->create($request->all());

        return redirect()->route('routines.index');
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
        app(RoutinesRepository::class)->update($request->all());

        return redirect()->route('routines.index');
    }
}
