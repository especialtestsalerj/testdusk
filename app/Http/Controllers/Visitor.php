<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Avatars as AvatarsRepository;
use App\Data\Repositories\Contacts;
use App\Data\Repositories\Reservations as ReservationsRepository;
use App\Data\Repositories\Visitors as VisitorsRepository;
use App\Data\Repositories\Sectors as SectorsRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\People as PeopleRepository;
use App\Http\Requests\VisitorCheckoutAll;
use App\Http\Requests\VisitorStore;
use App\Http\Requests\VisitorUpdate;
use App\Models\Document;
use App\Models\Reservation;
use App\Models\ReservationStatus;
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

        if($request->get('reservation_id')){
            $reservation = app(ReservationsRepository::class)->findById($request->get('reservation_id'));

            $reservation->reservation_status_id = ReservationStatus::where('name', 'VISITA REALIZADA')->first()->id;
            $reservation->save();
        }

        if ($request->get('contact') && $request->get('contact_type_id')) {
            app(Contacts::class)->firstOrCreateContact($request);
        }

        $request->merge(['document_id' => $document->id]);

        $visitor = app(VisitorsRepository::class)->create($request->all());

        $visitor->sectors()->attach($request->get('sector_id'));

        $visitor = $visitor->fresh();
        $visitor->searchable();

        return redirect()
            ->route('visitors.index')
            ->with('message', 'Visitante adicionado/a com sucesso!');
    }

    public function show($id)
    {
        formMode(Constants::FORM_MODE_SHOW);

        $visitor = VisitorModel::findOrFail($id)->append('photo');

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
        if ($request->get('visitor_id') != $id) {
            abort(400);
        }

        $request = $this->storeAvatar($request);

        $visitor = app(VisitorsRepository::class)->update($id, $request->all());

        if ($request->get('contact') && $request->get('contact_type_id')) {
            app(Contacts::class)->firstOrCreateContact($request);
        }
        $visitor->sectors()->sync($request->get('sector_id'));

        $visitor = $visitor->fresh();
        $visitor->searchable();

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

    public function checkoutAll(VisitorCheckoutAll $request)
    {
        foreach (app(VisitorsRepository::class)->allPending() as $visitor) {
            if (!is_null($request->get('exited_at'))) {
                $array = [];
                $array = array_add($array, 'exited_at', $request->get('exited_at'));
                app(VisitorsRepository::class)->update($visitor->id, $array);
            }
        }

        return redirect()
            ->route('visitors.index')
            ->with('message', 'Visitas finalizadas com sucesso!');
    }
}
