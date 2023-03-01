<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Stuffs as StuffsRepository;
use App\Data\Repositories\Sectors as SectorsRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Http\Requests\StuffStore as StuffRequest;
use App\Http\Requests\StuffUpdate as StuffUpdateRequest;
use App\Data\Repositories\Routines as RoutinesRepository;
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

    public function createFromDashboard($routine_id)
    {
        formMode(Constants::FORM_MODE_CREATE);

        $routine = app(RoutinesRepository::class)->findById([$routine_id]);

        return $this->view('stuffs.form-dashboard')->with([
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

    public function store(StuffRequest $request)
    {
        $stuff = app(StuffsRepository::class)->create($request->all());

        return redirect()
            ->route('routines.show', $stuff->routine_id)
            ->with('message', 'Material adicionado com sucesso!');
    }

    public function storeFromDashboard(StuffRequest $request)
    {
        $stuff = app(StuffsRepository::class)->create($request->all());

        return redirect()
            ->route('stuffs.index', $stuff->routine_id)
            ->with('message', 'Material adicionado com sucesso!');
    }

    public function show($id)
    {
        formMode(Constants::FORM_MODE_SHOW);

        $stuff = app(StuffsRepository::class)->findById($id);
        $routine = app(RoutinesRepository::class)->findById($stuff->routine_id);

        return $this->view('stuffs.form')->with([
            'routine_id' => $stuff->routine_id,
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

    public function showFromDashboard($routine_id, $id)
    {
        formMode(Constants::FORM_MODE_SHOW);

        $stuff = app(StuffsRepository::class)->findById($id);
        $routine = app(RoutinesRepository::class)->findById($stuff->routine_id);

        return $this->view('stuffs.form-dashboard')->with([
            'routine_id' => $stuff->routine_id,
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

    public function update(StuffUpdateRequest $request, $id)
    {
        $stuff = app(StuffsRepository::class)->update($id, $request->all());

        return redirect()
            ->route('routines.show', $stuff->routine_id)
            ->with('message', 'Material alterado com sucesso!');
    }

    public function updateFromDashboard(StuffUpdateRequest $request, $routine_id, $id)
    {
        $stuff = app(StuffsRepository::class)->update($id, $request->all());

        return redirect()
            ->route('stuffs.index', $routine_id)
            ->with('message', 'Material alterado com sucesso!');
    }

    public function delete($id)
    {
        $stuff = app(StuffsRepository::class)->findById($id);

        $stuff->delete($id);

        return redirect()
            ->route('routines.show', $stuff->routine_id)
            ->with('message', 'Material removido com sucesso!');
    }

    public function deleteFromDashboard($id)
    {
        $stuff = app(StuffsRepository::class)->findById($id);

        $stuff->delete($id);

        return redirect()
            ->route('stuffs.index', $stuff->routine_id)
            ->with('message', 'Material removido com sucesso!');
    }
}
