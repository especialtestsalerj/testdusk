<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Cautions as CautionsRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\People as PeopleRepository;
use App\Data\Repositories\Sectors as SectorsRepository;
use App\Http\Requests\CautionStore as CautionRequest;
use App\Http\Requests\CautionUpdate as CautionUpdateRequest;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Support\Constants;

class Caution extends Controller
{
    public function index()
    {
        return $this->view('cautions.index')->with(
            'cautions',
            app(CautionsRepository::class)->all()
        );
    }

    public function create($routine_id)
    {
        formMode(Constants::FORM_MODE_CREATE);

        return $this->view('cautions.form')->with([
            'routine_id' => $routine_id,
            'caution' => app(CautionsRepository::class)->new(),
            'users' => app(UsersRepository::class)->all('name'),
            'people' => app(PeopleRepository::class)->all('name'),
            'sectors' => app(SectorsRepository::class)->all('name'),
        ]);
    }

    public function store(CautionRequest $request)
    {
        $values = $request->all();
        $ano = substr($values['started_at'], 0, 4);
        $values = array_merge($values, [
            'protocol_number' => app(CautionsRepository::class)->makeProtocolNumber($ano),
        ]);

        $caution = app(CautionsRepository::class)->create($values);
        $routine = app(RoutinesRepository::class)->findById($caution->routine_id);

        return redirect()
            ->route('routines.show', $caution->routine_id)
            ->with(['routine' => $routine]);
    }

    public function show($id)
    {
        $caution = app(CautionsRepository::class)->findById($id);
        return $this->view('cautions.form')->with([
            'routine_id' => $caution->routine_id,
            'caution' => $caution,
            'users' => app(UsersRepository::class)->all('name'),
            'people' => app(PeopleRepository::class)->all('name'),
            'sectors' => app(SectorsRepository::class)->all('name'),
        ]);
    }

    public function update(CautionUpdateRequest $request, $id)
    {
        app(CautionsRepository::class)->update($id, $request->all());

        return redirect()->route('cautions.index');
    }
}
