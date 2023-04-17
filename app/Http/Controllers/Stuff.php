<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Stuffs as StuffsRepository;
use App\Data\Repositories\Sectors as SectorsRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Http\Requests\StuffStore;
use App\Http\Requests\StuffUpdate;
use App\Http\Requests\StuffDestroy;
use App\Support\Constants;

class Stuff extends Controller
{
    public function create($routine_id)
    {
        formMode(Constants::FORM_MODE_CREATE);

        $routine = app(RoutinesRepository::class)->findById([$routine_id]);

        return $this->view('stuffs.form')->with([
            'routine_id' => $routine_id,
            'routine' => $routine,
            'stuff' => app(StuffsRepository::class)->new(),
            'sectors' => app(SectorsRepository::class)
                ->disablePagination()
                ->all(),
            'users' => app(UsersRepository::class)
                ->disablePagination()
                ->all(),
        ]);
    }

    public function store(StuffStore $request, $routine_id)
    {
        app(StuffsRepository::class)->create($request->all());

        return redirect()
            ->route($request['redirect'], $routine_id)
            ->with('message', 'Material adicionado com sucesso!');
    }

    public function show($routine_id, $id)
    {
        formMode(Constants::FORM_MODE_SHOW);

        $stuff = app(StuffsRepository::class)->findById($id);
        $routine = app(RoutinesRepository::class)->findById($routine_id);

        return $this->view('stuffs.form')->with([
            'routine_id' => $routine_id,
            'routine' => $routine,
            'stuff' => $stuff,
            'sectors' => app(SectorsRepository::class)
                ->disablePagination()
                ->all(),
            'users' => app(UsersRepository::class)
                ->disablePagination()
                ->all(),
        ]);
    }

    public function update(StuffUpdate $request, $routine_id, $id)
    {
        app(StuffsRepository::class)->update($id, $request->all());

        return redirect()
            ->route($request['redirect'], $routine_id)
            ->with('message', 'Material alterado com sucesso!');
    }

    public function destroy(StuffDestroy $request, $routine_id, $id)
    {
        $stuff = app(StuffsRepository::class)->findById($id);

        $stuff->delete($id);

        return redirect()
            ->route($request['redirect'], $routine_id)
            ->with('message', 'Material removido com sucesso!');
    }
}
