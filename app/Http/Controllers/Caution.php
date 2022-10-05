<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Cautions as CautionsRepository;
use App\Data\Repositories\Events as EventsRepository;
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

        $routine = app(RoutinesRepository::class)->findById([$routine_id]);

        return $this->view('cautions.form')->with([
            'routine_id' => $routine_id,
            'routine' => $routine,
            'caution' => app(CautionsRepository::class)->new(),
            'people' => app(PeopleRepository::class)->all('name'),
            'sectors' => app(SectorsRepository::class)->all('name'),
            'users' => app(UsersRepository::class)->all('name'),
        ]);
    }

    public function store(CautionRequest $request)
    {
        $person = app(PeopleRepository::class)->createOrUpdateFromRequest($request->all());

        $request->merge(['person_id' => $person->id]);

        $values = $request->all();
        $ano = substr($values['started_at'], 0, 4);
        $values = array_merge($values, [
            'protocol_number' => app(CautionsRepository::class)->makeProtocolNumber($ano),
        ]);

        $caution = app(CautionsRepository::class)->create($values);
        //$routine = app(RoutinesRepository::class)->findById($caution->routine_id);

        /*return redirect()
            ->route('routines.show', $caution->routine_id)
            ->with(['routine' => $routine])
            ->with('status', 'Cautela adicionada com sucesso!');*/

        return redirect()
            ->route('routines.show', $caution->routine_id)
            ->with('status', 'Cautela adicionada com sucesso!');
    }

    public function show($id)
    {
        formMode(Constants::FORM_MODE_SHOW);

        $caution = app(CautionsRepository::class)->findById($id);
        return $this->view('cautions.form')->with([
            'routine_id' => $caution->routine_id,
            'caution' => $caution,
            'people' => app(PeopleRepository::class)->all('name'),
            'sectors' => app(SectorsRepository::class)->all('name'),
            'users' => app(UsersRepository::class)->all('name'),
        ]);
    }

    public function update(CautionUpdateRequest $request, $id)
    {
        $person = app(PeopleRepository::class)->createOrUpdateFromRequest($request->all());

        $request->merge(['person_id' => $person->id]);

        $caution = app(CautionsRepository::class)->update($id, $request->all());

        return redirect()
            ->route('routines.show', $caution->routine_id)
            ->with('status', 'Cautela alterada com sucesso!');
    }
}
