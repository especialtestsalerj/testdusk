<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Stuffs as StuffsRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\Visitors as VisitorsRepository;
use App\Http\Requests\StuffStore as StuffRequest;
use App\Http\Requests\StuffUpdate as StuffUpdateRequest;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Support\Constants;

class Stuff extends Controller
{
    public function index()
    {
        return $this->view('stuffs.index')->with('stuffs', app(StuffsRepository::class)->all());
    }

    public function create($routine_id)
    {
        formMode(Constants::FORM_MODE_CREATE);

        return $this->view('stuffs.form')->with([
            'routine_id' => $routine_id,
            'stuff' => app(StuffsRepository::class)->new(),
            'users' => app(UsersRepository::class)->all('name'),
        ]);
    }

    public function store(StuffRequest $request)
    {
        $stuff = app(StuffsRepository::class)->create($request->all());
        $routine = app(RoutinesRepository::class)->findById($stuff->routine_id);

        return redirect()
            ->route('routines.show', $stuff->routine_id)
            ->with(['routine' => $routine])
            ->with('status', 'Material adicionado com sucesso!');
    }

    public function show($id)
    {
        $stuff = app(StuffsRepository::class)->findById($id);
        return $this->view('stuffs.form')->with([
            'routine_id' => $stuff->routine_id,
            'stuff' => $stuff,
            'users' => app(UsersRepository::class)->all('name'),
        ]);
    }

    public function update(StuffUpdateRequest $request, $id)
    {
        $stuff = app(StuffsRepository::class)->create($request->all());
        app(StuffsRepository::class)->update($id, $request->all());

        return redirect()->route('routines.show', $stuff->routine_id)->with('status', 'Material alterado com sucesso!');
    }
}
