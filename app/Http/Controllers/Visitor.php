<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Avatars;
use App\Data\Repositories\Documents;
use App\Data\Repositories\Visitors;
use App\Data\Repositories\Visitors as VisitorsRepository;
use App\Data\Repositories\Sectors as SectorsRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Data\Repositories\People as PeopleRepository;
use App\Http\Requests\VisitorStore;
use App\Http\Requests\VisitorUpdate;
use App\Http\Requests\VisitorDestroy;
use App\Models\Document;
use App\Models\Visitor as VisitorModel;
use App\Support\Constants;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Visitor extends Controller
{
    public function create()
    {
        formMode(Constants::FORM_MODE_CREATE);

        $person_id = null;
        if (!empty(request()->get('person_id'))) {
            $people = app(PeopleRepository::class)->findById(request()->get('person_id'));
            $person_id = $people->id;
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
        $photo = $request->get('photo');
        if ($photo) {
            $avatar = app(Avatars::class)->storePhysicalFile($photo);
            $request->merge(['avatar_id' => $avatar->id]);
        }

        $person = app(PeopleRepository::class)->createOrUpdateFromRequest($request->all());

        $request->merge(['person_id' => $person->id]);

        $request->merge(['number' => remove_punctuation($request->get('document_number'))]);

        $document = Document::firstOrCreate([
            'person_id' => $request->get('person_id'),
            'number' => mb_strtoupper(remove_punctuation($request->get('document_number'))),
            'document_type_id' => $request->get('document_type_id'),
        ]);

        $request->merge(['document_id' => $document->id]);

        app(VisitorsRepository::class)->create($request->all());

        return redirect()
            ->route('visitors.index')
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

    public function update(VisitorUpdate $request, $id)
    {
        app(VisitorsRepository::class)->update($id, $request->all());

        return redirect()
            ->route($request['redirect'])
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

    public function card(Request $request, $uuid = null)
    {
        if ($uuid) {
            if (Uuid::isValid($uuid)) {
                $visitor = VisitorModel::where('uuid', $uuid)->firstOrFail();
                return $visitor;
            } else {
                abort(404);
            }
        } else {
            if ($timestamp = $request->query('timestamp')) {
                return $visitor = app(Visitors::class)->getAnonymousVisitor(
                    Carbon::createFromTimestamp($timestamp)
                );
            } else {
                abort(404);
            }
        }
    }
}
