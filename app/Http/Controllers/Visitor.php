<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Avatars as AvatarsRepository;
use App\Data\Repositories\Visitors as VisitorsRepository;
use App\Data\Repositories\Sectors as SectorsRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\People as PeopleRepository;
use App\Http\Requests\VisitorStore;
use App\Http\Requests\VisitorUpdate;
use App\Http\Requests\VisitorDestroy;
use App\Models\Document;
use App\Models\Visitor as VisitorModel;
use App\Support\Constants;
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
        $request = $this->storeAvatar($request);

        $person = app(PeopleRepository::class)->createOrUpdateFromRequest($request->all());

        $request->merge(['person_id' => $person->id]);

        $request->merge(['number' => remove_punctuation($request->get('document_number'))]);

        $document = Document::firstOrCreate([
            'person_id' => $request->get('person_id'),
            'number' => convert_case(
                remove_punctuation($request->get('document_number')),
                MB_CASE_UPPER
            ),
            'document_type_id' => $request->get('document_type_id'),
            'state_id' => $request->get('state_document_id'),
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

        $visitor = app(VisitorsRepository::class)
            ->findById($id)
            ->append('photo');

        return $this->view('livewire.visitors.form')->with([
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
        $request = $this->storeAvatar($request);

        app(VisitorsRepository::class)->update($id, $request->all());

        return redirect()
            ->route('visitors.index')
            ->with('message', 'Visitante alterado/a com sucesso!');
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
                return $visitor = app(VisitorsRepository::class)->getAnonymousVisitor(
                    Carbon::createFromTimestamp($timestamp)
                );
            } else {
                abort(404);
            }
        }
    }

    /**
     * @param VisitorStore $request
     * @return VisitorStore $request
     */
    protected function storeAvatar(VisitorStore $request)
    {
        $photo = $request->get('photo');
        if ($photo) {
            $avatar = app(AvatarsRepository::class)->store($photo);
            $request->merge(['avatar_id' => $avatar->id]);
        } else {
            $request->merge(['avatar_id' => null]);
        }
        return $request;
    }
}
