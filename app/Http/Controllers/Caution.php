<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Cautions as CautionsRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\Visitors as VisitorsRepository;
use App\Data\Repositories\Sectors as SectorsRepository;
use App\Http\Requests\CautionStore as CautionRequest;
use App\Http\Requests\CautionUpdate as CautionUpdateRequest;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Data\Repositories\People as PeopleRepository;
use App\Data\Repositories\Cabinets as CabinetsRepository;
use App\Data\Repositories\Shelves as ShelvesRepository;
use App\Data\Repositories\CautionWeapons as CautionWeaponsRepository;

use App\Support\Constants;
use Illuminate\Foundation\Http\FormRequest;

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

        $routine = app(RoutinesRepository::class)->findById($routine_id);

        $visitors = app(VisitorsRepository::class)
            ->disablePagination()
            ->findByRoutine($routine_id);

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
        $visitor = app(VisitorsRepository::class)->findById($request->visitor_id);

        $personRequest = new FormRequest();
        $personRequest->merge(['certificate_type' => $request->certificate_type]);
        $personRequest->merge(['id_card' => $request->id_card]);
        $personRequest->merge(['certificate_number' => $request->certificate_number]);
        $personRequest->merge(['certificate_valid_until' => $request->certificate_valid_until]);

        app(PeopleRepository::class)->update($visitor->person_id, $personRequest->all());

        $request->request->remove('certificate_type');
        $request->request->remove('id_card');
        $request->request->remove('certificate_number');
        $request->request->remove('certificate_valid_until');

        $values = $request->all();
        $ano = substr($values['started_at'], 0, 4);
        $values = array_merge($values, [
            'protocol_number' => app(CautionsRepository::class)->makeProtocolNumber($ano),
        ]);

        $caution = app(CautionsRepository::class)->create($values);

        return redirect()
            ->route('routines.show', $caution->routine_id)
            ->with('status', 'Cautela adicionada com sucesso!');
    }

    public function show($id)
    {
        formMode(Constants::FORM_MODE_SHOW);

        $caution = app(CautionsRepository::class)->findById($id);
        $routine = app(RoutinesRepository::class)->findById($caution->routine_id);
        $cautionWeapons = app(CautionWeaponsRepository::class)->getByCautionId($caution->id);

        return $this->view('cautions.form')->with([
            'routine_id' => $caution->routine_id,
            'caution' => $caution,
            'routine' => $routine,
            'visitors' => app(VisitorsRepository::class)->all(),
            'sectors' => app(SectorsRepository::class)->all(),
            'users' => app(UsersRepository::class)->all(),
            'cabinets' => app(CabinetsRepository::class)->all(),
            'shelves' => app(ShelvesRepository::class)->all(),
            'cautionWeapons' => $cautionWeapons,
        ]);
    }

    public function update(CautionUpdateRequest $request, $id)
    {
        $visitor = app(VisitorsRepository::class)->findById($request->visitor_id);

        $personRequest = new FormRequest();
        $personRequest->merge(['certificate_type' => $request->certificate_type]);
        $personRequest->merge(['id_card' => $request->id_card]);
        $personRequest->merge(['certificate_number' => $request->certificate_number]);
        $personRequest->merge(['certificate_valid_until' => $request->certificate_valid_until]);

        app(PeopleRepository::class)->update($visitor->person_id, $personRequest->all());

        $request->request->remove('certificate_type');
        $request->request->remove('id_card');
        $request->request->remove('certificate_number');
        $request->request->remove('certificate_valid_until');

        $caution = app(CautionsRepository::class)->update($id, $request->all());

        return redirect()
            ->route('routines.show', $caution->routine_id)
            ->with('status', 'Cautela alterada com sucesso!');
    }
}
