<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Cautions as CautionsRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\Visitors as VisitorsRepository;
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

        //app(VisitorsRepository::class)->findByRoutineId([$routine_id])
        $visitors = app(VisitorsRepository::class)->findByRoutine($routine_id);

        return $this->view('cautions.form')->with([
            'routine_id' => $routine_id,
            'routine' => $routine,
            'caution' => app(CautionsRepository::class)->new(),
            'visitors' => $visitors,
            'sectors' => app(SectorsRepository::class)->all(),
            'users' => app(UsersRepository::class)->all(),
        ]);
    }

    public function store(CautionRequest $request)
    {
        //$person = app(PeopleRepository::class)->createOrUpdateFromRequest($request->all());

        //$request->merge(['person_id' => $person->id]);

        $values = $request->all();
        $ano = substr($values['started_at'], 0, 4);
        $values = array_merge($values, [
            'protocol_number' => app(CautionsRepository::class)->makeProtocolNumber($ano),
        ]);

        $caution = app(CautionsRepository::class)->create($values);

        return redirect()
            ->route('cautions.show', $caution->routine_id)
            ->with('status', 'Cautela adicionada com sucesso!');
    }

    public function show($id)
    {
        formMode(Constants::FORM_MODE_SHOW);
        //'people' => app(PeopleRepository::class)->all(),
        $caution = app(CautionsRepository::class)->findById($id);
        return $this->view('cautions.form')->with([
            'routine_id' => $caution->routine_id,
            'caution' => $caution,
            'visitors' => app(VisitorsRepository::class)->all(),
            'sectors' => app(SectorsRepository::class)->all(),
            'users' => app(UsersRepository::class)->all(),
        ]);
    }

    public function update(CautionUpdateRequest $request, $id)
    {
        //$person = app(PeopleRepository::class)->createOrUpdateFromRequest($request->all());

        //$request->merge(['person_id' => $person->id]);

        $caution = app(CautionsRepository::class)->update($id, $request->all());

        return redirect()
            ->route('routines.show', $caution->routine_id)
            ->with('status', 'Cautela alterada com sucesso!');
    }
}
