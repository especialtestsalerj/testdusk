<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Data\Repositories\Visitors as VisitorsRepository;
use App\Data\Repositories\Cautions as CautionsRepository;
use App\Data\Repositories\Sectors as SectorsRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\People as PeopleRepository;
use App\Data\Repositories\CautionWeapons as CautionWeaponsRepository;
use App\Data\Repositories\Cabinets as CabinetsRepository;
use App\Data\Repositories\Shelves as ShelvesRepository;
use App\Http\Requests\CautionStore;
use App\Http\Requests\CautionUpdate;
use App\Http\Requests\CautionDestroy;
use App\Services\PDF\Service as PDF;
use App\Support\Constants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class Caution extends Controller
{
    public function create($routine_id)
    {
        formMode(Constants::FORM_MODE_CREATE);

        $routine = app(RoutinesRepository::class)->findById([$routine_id]);

        $visitors = app(VisitorsRepository::class)->findByRoutineWithoutPending($routine_id);

        return $this->view('cautions.form')->with([
            'routine_id' => $routine_id,
            'routine' => $routine,
            'caution' => app(CautionsRepository::class)->new(),
            'visitors' => $visitors,
            'sectors' => app(SectorsRepository::class)
                ->disablePagination()
                ->all(),
            'users' => app(UsersRepository::class)
                ->disablePagination()
                ->all(),
        ]);
    }

    public function store(CautionStore $request, $routine_id)
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
            ->route('cautions.show', [
                'routine_id' => $routine_id,
                'id' => $caution->id,
                'redirect' => $request['redirect'],
            ])
            ->with('message', 'Cautela adicionada com sucesso! Agora informe pelo menos uma arma.');
    }

    public function show($routine_id, $id)
    {
        formMode(Constants::FORM_MODE_SHOW);

        $caution = app(CautionsRepository::class)->findById($id);
        $routine = app(RoutinesRepository::class)->findById($routine_id);
        $cautionWeapons = app(CautionWeaponsRepository::class)->getByCautionId($caution->id);

        return $this->view('cautions.form')->with([
            'routine_id' => $routine_id,
            'routine' => $routine,
            'caution' => $caution,
            'visitors' => app(VisitorsRepository::class)
                ->disablePagination()
                ->all(),
            'sectors' => app(SectorsRepository::class)
                ->disablePagination()
                ->all(),
            'users' => app(UsersRepository::class)
                ->disablePagination()
                ->all(),
            'cabinets' => app(CabinetsRepository::class)
                ->disablePagination()
                ->all(),
            'shelves' => app(ShelvesRepository::class)
                ->disablePagination()
                ->all(),
            'cautionWeapons' => $cautionWeapons,
        ]);
    }

    public function update(CautionUpdate $request, $routine_id, $id)
    {
        DB::transaction(function () use ($request, $routine_id, $id) {
            $currentCaution = app(CautionsRepository::class)->findById($id);

            //syncronizing cautions
            if (isset($currentCaution?->old_id)) {
                $caution = app(CautionsRepository::class)->findById($currentCaution->old_id);

                if (isset($caution)) {
                    $array = [];
                    $array = array_add($array, 'concluded_at', $request['concluded_at']);

                    app(CautionsRepository::class)->update($currentCaution->old_id, $array);
                }

                $cautions = app(CautionsRepository::class)->findOld($currentCaution->old_id);
                if (isset($cautions) && count($cautions) > 0) {
                    foreach ($cautions as $caution) {
                        if ($caution->id != $currentCaution->id && isset($caution?->old_id)) {
                            $array = [];
                            $array = array_add($array, 'concluded_at', $request['concluded_at']);
                            app(CautionsRepository::class)->update($caution->id, $array);
                        }
                    }
                }
            }

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

            app(CautionsRepository::class)->update($id, $request->all());
        });

        return redirect()
            ->route($request['redirect'], $routine_id)
            ->with('message', 'Cautela alterada com sucesso!');
    }

    public function destroy(CautionDestroy $request, $routine_id, $id)
    {
        $caution = app(CautionsRepository::class)->findById($id);

        //deleting weapons
        $cautionWeapons = app(CautionWeaponsRepository::class)->getByCautionId($id);
        foreach ($cautionWeapons as $cautionWeapon) {
            $cautionWeapon->delete($cautionWeapon->id);
        }

        //deleting caution
        $caution->delete($id);

        return redirect()
            ->route($request['redirect'], $routine_id)
            ->with('message', 'Cautela removida com sucesso!');
    }

    public function receipt($routine_id, $id)
    {
        $caution = app(CautionsRepository::class)->findById($id);
        $cautionWeapons = app(CautionWeaponsRepository::class)->getByCautionId($caution->id);

        return app(PDF::class)
            ->initialize(
                view('cautions.pdf')
                    ->with(
                        'logoBlob',
                        base64_encode(file_get_contents(public_path('img/logo-alerj.png')))
                    )
                    ->with('caution', $caution)
                    ->with('cautionWeapons', $cautionWeapons)
                    ->render(),
                'A4',
                'portrait'
            )
            ->download(make_pdf_filename('Cautela' . $caution?->protocol_number));
    }
}
