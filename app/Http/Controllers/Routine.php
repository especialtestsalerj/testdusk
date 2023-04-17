<?php

namespace App\Http\Controllers;
use App\Data\Repositories\CautionWeapons as CautionWeaponsRepository;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Data\Repositories\Shifts as ShiftsRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\Visitors as VisitorsRepository;
use App\Http\Requests\RoutineStore;
use App\Http\Requests\RoutineUpdate;
use App\Http\Requests\RoutineFinish;
use App\Support\Constants;
use App\Models\Visitor;
use App\Models\Caution;
use Illuminate\Support\Facades\DB;
use App\Models\CautionWeapon;

class Routine extends Controller
{
    public function index()
    {
        return $this->view('routines.index')->with(
            'routines',
            app(RoutinesRepository::class)
                ->disablePagination()
                ->all()
        );
    }

    public function create()
    {
        if (app(RoutinesRepository::class)->hasRoutineOpened()) {
            return redirect()
                ->route('routines.index')
                ->withErrors([
                    'Existe(m) rotina(s) em aberto. Você deve finalizar todas as rotinas para cadastrar uma nova.',
                ]);
        }

        formMode(Constants::FORM_MODE_CREATE);

        $routine = app(RoutinesRepository::class)->new();
        $routine->status = true;

        return $this->view('routines.form')->with([
            'routine' => $routine,
            'shifts' => app(ShiftsRepository::class)
                ->disablePagination()
                ->all(),
            'entrancedUsers' => app(UsersRepository::class)
                ->disablePagination()
                ->all(),
            'exitedUsers' => app(UsersRepository::class)
                ->disablePagination()
                ->all(),
        ]);
    }

    public function store(RoutineStore $request)
    {
        DB::transaction(function () use ($request) {
            //Catch last routine
            $oldRoutineId = DB::table('routines')->max('id');
            $oldRoutine = app(RoutinesRepository::class)->findById($oldRoutineId);

            $newRoutine = app(RoutinesRepository::class)->create($request->all());

            if (isset($oldRoutine)) {
                $this->storePendingVisitors($oldRoutine->getPendingVisitors(), $newRoutine->id);

                $this->storePendingCautions($oldRoutine->getPendingCautions(), $newRoutine->id);
            }
        });

        return redirect()
            ->route('routines.index')
            ->with('message', 'Rotina adicionada com sucesso!');
    }

    public function show($id)
    {
        formMode(Constants::FORM_MODE_SHOW);

        return $this->view('routines.form')->with([
            'routine' => app(RoutinesRepository::class)->findById($id),
            'shifts' => app(ShiftsRepository::class)
                ->disablePagination()
                ->all(),
            'entrancedUsers' => app(UsersRepository::class)
                ->disablePagination()
                ->all(),
            'exitedUsers' => app(UsersRepository::class)
                ->disablePagination()
                ->all(),
        ]);
    }

    public function update(RoutineUpdate $request, $id)
    {
        app(RoutinesRepository::class)->update($id, $request->all());

        return redirect()
            ->route('routines.index')
            ->with('message', 'Rotina alterada com sucesso!');
    }

    public function finish(RoutineFinish $request, $id)
    {
        $request->merge(['status' => false]);
        app(RoutinesRepository::class)->update($id, $request->all());

        return redirect()
            ->route('routines.index')
            ->with('message', 'Rotina finalizada com sucesso!');
    }

    public function storePendingVisitors($pendingVisitors, $newRoutineId)
    {
        //Retrieve pending visitors from the last completed routine
        foreach ($pendingVisitors as $pendingVisitor) {
            $excludeKeys = ['id', 'created_by_id', 'updated_by_id', 'created_at', 'updated_at'];
            $array = array_diff_key($pendingVisitor->toArray(), array_flip($excludeKeys));

            //create visitor
            $visitor = new Visitor();
            $visitor->fill($array);
            $visitor->routine_id = $newRoutineId;
            $visitor->old_id = $pendingVisitor->old_id ?? $pendingVisitor->id;
            $visitor->save();
        }
    }

    public function storePendingCautions($pendingCautions, $newRoutineId)
    {
        //Retrieve pending cautions from the last completed routine
        foreach ($pendingCautions as $pendingCaution) {
            //Check if the visitor already exists in the new routine
            $visitor = app(VisitorsRepository::class)->findOld(
                $newRoutineId,
                $pendingCaution->visitor->old_id ?? $pendingCaution->visitor_id
            );

            if (isset($visitor) && count($visitor)) {
                $visitorId = $visitor[0]->id;
                $visitorOldId = null;
            } else {
                $excludeKeys = ['id', 'created_by_id', 'updated_by_id', 'created_at', 'updated_at'];
                $array = array_diff_key($pendingCaution->toArray(), array_flip($excludeKeys));

                $visitor = new Visitor();
                $visitor->fill($array);
                $visitor->routine_id = $newRoutineId;
                $visitor->entranced_at = $pendingCaution->visitor->entranced_at;
                $visitor->exited_at = $pendingCaution->visitor->exited_at;
                $visitor->person_id = $pendingCaution->visitor->person_id;
                $visitor->sector_id = $pendingCaution->visitor->sector_id;
                $visitor->duty_user_id = $pendingCaution->visitor->duty_user_id;
                $visitor->description = $pendingCaution->visitor->description;
                $visitor->old_id = $pendingCaution->visitor->old_id ?? $pendingCaution->visitor_id;
                /*$visitor->old_id = $pendingCaution->visitor->old_id
                    ? $pendingCaution->old_id
                    : $pendingCaution->visitor_id;*/
                $visitor->save();

                $visitorId = $visitor->id;
                $visitorOldId = $visitor->old_id;
            }

            $excludeKeys = ['id', 'created_by_id', 'updated_by_id', 'created_at', 'updated_at'];
            $array = array_diff_key($pendingCaution->toArray(), array_flip($excludeKeys));

            //create caution
            $caution = new Caution();
            $caution->fill($array);
            $caution->routine_id = $newRoutineId;
            $caution->visitor_id = $visitorId;
            $caution->old_id = $pendingCaution->old_id ?? $pendingCaution->id;
            $caution->visitor_old_id = $visitorOldId;
            $caution->save();

            //create weapons
            $oldCautionWeapons = app(CautionWeaponsRepository::class)->findByCaution(
                $pendingCaution->id
            );
            if (isset($oldCautionWeapons)) {
                foreach ($oldCautionWeapons as $oldCautionWeapon) {
                    $excludeKeys = [
                        'id',
                        'created_by_id',
                        'updated_by_id',
                        'created_at',
                        'updated_at',
                    ];
                    $array = array_diff_key($oldCautionWeapon->toArray(), array_flip($excludeKeys));

                    $cautionWeapon = new CautionWeapon();
                    $cautionWeapon->fill($array);
                    $cautionWeapon->caution_id = $caution->id;
                    $cautionWeapon->old_id = $oldCautionWeapon->old_id ?? $oldCautionWeapon->id;
                    $cautionWeapon->save();
                }
            }
        }
    }
}
