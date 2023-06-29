<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Documents;
use App\Data\Repositories\Visitors as VisitorsRepository;
use App\Data\Repositories\Sectors as SectorsRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Data\Repositories\People as PeopleRepository;
use App\Http\Requests\VisitorStore;
use App\Http\Requests\VisitorUpdate;
use App\Http\Requests\VisitorDestroy;
use App\Models\Document;
use App\Support\Constants;
use Illuminate\Support\Facades\DB;

class Visitor extends Controller
{
    public function create()
    {
        formMode(Constants::FORM_MODE_CREATE);

        $person_id = null;
        if (!empty(request()->get('person_id'))) {
            $people = app(PeopleRepository::class)->findById(request()->get('person_id'));
            $person_id = $people->id;

            //            dd($person_id);
        } else {
            $people = app(PeopleRepository::class)
                ->disablePagination()
                ->all();
        }

        return $this->view('visitors.form')->with([
            'visitor' => app(VisitorsRepository::class)->new(),
            'people' => $people,
            'person_id' => $person_id,
            'sectors' => app(SectorsRepository::class)
                ->disablePagination()
                ->all(),
            'users' => app(UsersRepository::class)
                ->disablePagination()
                ->all(),
        ]);
    }

    public function store(VisitorStore $request)
    {
        $person = app(PeopleRepository::class)->createOrUpdateFromRequest($request->all());

        $request->merge(['person_id' => $person->id]);

        $request->merge(['number' => $request->get('document_number')]);

        $document = Document::firstOrCreate([
            'person_id' => $request->get('person_id'),
            'number' => $request->get('document_number'),
            'document_type_id' => $request->get('document_type_id'),
        ]);

        $request->merge(['document_id' => $document->id]);

        app(VisitorsRepository::class)->create($request->all());

        return redirect()
            ->route('people.index')
            ->with('message', 'Visitante adicionado/a com sucesso!');
    }

    public function show($id)
    {
        formMode(Constants::FORM_MODE_SHOW);

        $visitor = app(VisitorsRepository::class)->findById($id);

        return $this->view('visitors.form')->with([
            'visitor' => $visitor,
            'person_id' => $visitor->person_id,
            'people' => app(PeopleRepository::class)
                ->disablePagination()
                ->all(),
            'sectors' => app(SectorsRepository::class)
                ->disablePagination()
                ->all(),
            'users' => app(UsersRepository::class)
                ->disablePagination()
                ->all(),
            'mode' => 'show' . (request()->query('disabled') ? '-read-only' : ''),
        ]);
    }

    public function update(VisitorUpdate $request, $routine_id, $id)
    {
        DB::transaction(function () use ($request, $routine_id, $id) {
            $currentVisitor = app(VisitorsRepository::class)->findById($id);

            //syncronizing visitors
            if (isset($currentVisitor?->old_id)) {
                $visitor = app(VisitorsRepository::class)->findByOldId($currentVisitor->old_id);

                if (isset($visitor)) {
                    $array = [];
                    $array = array_add($array, 'exited_at', $request['exited_at']);

                    app(VisitorsRepository::class)->update($currentVisitor->old_id, $array);
                }

                $visitors = app(VisitorsRepository::class)->findByOldId($currentVisitor->old_id);
                if (isset($visitors)) {
                    foreach ($visitors as $visitor) {
                        if ($visitor->id != $currentVisitor->id && isset($visitor?->old_id)) {
                            $array = [];
                            $array = array_add($array, 'exited_at', $request['exited_at']);
                            app(VisitorsRepository::class)->update($visitor->id, $array);
                        }
                    }
                }
            }

            $person = app(PeopleRepository::class)->createOrUpdateFromRequest($request->all());

            $request->merge(['person_id' => $person->id]);

            app(VisitorsRepository::class)->update($id, $request->all());
        });

        return redirect()
            ->route($request['redirect'], $routine_id)
            ->with('message', 'Visitante alterado/a com sucesso!');
    }

    public function destroy(VisitorDestroy $request, $routine_id, $id)
    {
        $visitor = app(VisitorsRepository::class)->findById($id);

        $visitor->delete($id);

        return redirect()
            ->route($request['redirect'], $routine_id)
            ->with('message', 'Visitante removido/a com sucesso!');
    }

    public function card()
    {
        return view('visitors.card');
    }

}
