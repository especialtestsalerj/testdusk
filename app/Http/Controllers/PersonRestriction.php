<?php

namespace App\Http\Controllers;
use App\Data\Repositories\PersonRestrictions as PersonRestrictionsRepository;
use App\Http\Requests\PersonRestrictionStore;
use App\Http\Requests\PersonRestrictionUpdate;
use App\Http\Requests\PersonRestrictionDestroy;

use App\Models\Person;

use App\Support\Constants;

class PersonRestriction extends Controller
{
    public function index()
    {
        return $this->view('person-restrictions.index')->with(
            'personRestrictions',
            app(PersonRestrictionsRepository::class)
                ->disablePagination()
                ->all()
        );
    }

    public function create()
    {
        formMode(Constants::FORM_MODE_CREATE);

        return $this->view('person-restrictions.form')->with([
            'personRestriction' => app(PersonRestrictionsRepository::class)->new(),
            'people' => Person::all()->sortBy('name'),
        ]);
    }

    public function store(PersonRestrictionStore $request)
    {
        app(PersonRestrictionsRepository::class)->create($request->all());

        return redirect()
            ->route('person-restrictions.index')
            ->with('message', 'Restrição adicionada com sucesso!');
    }

    public function show($id)
    {
        formMode(Constants::FORM_MODE_SHOW);

        return $this->view('person-restrictions.form')->with([
            'personRestriction' => app(PersonRestrictionsRepository::class)->findById($id),
        ]);
    }

    public function update(PersonRestrictionUpdate $request, $id)
    {
        app(PersonRestrictionsRepository::class)->update($id, $request->all());

        return redirect()
            ->route('person-restrictions.index')
            ->with('message', 'Restrição alterada com sucesso!');
    }

    public function destroy(PersonRestrictionDestroy $request, $id)
    {
        $personRestriction = app(PersonRestrictionsRepository::class)->findById($id);

        $personRestriction->delete($id);

        return redirect()
            ->route('person-restrictions.index')
            ->with('message', 'Restrição removida com sucesso!');
    }
}
