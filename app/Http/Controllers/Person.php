<?php

namespace App\Http\Controllers;

use App\Data\Repositories\People as PeopleRepository;
use App\Data\Repositories\Genders as GendersRepository;
use App\Data\Repositories\DisabilityTypes as DisabilityTypesRepository;
use App\Http\Requests\PersonUpdate;
use App\Models\Disability;
use App\Models\Person as PersonModel;

class Person extends Controller
{
    /*public function show($id)
    {
        formMode(Constants::FORM_MODE_SHOW);

        $person = app(PeopleRepository::class)->findById($id);

        return $this->view('livewire.people.form')->with([
            'person' => $person,
            'genders' => app(GendersRepository::class)
                ->disablePagination()
                ->all(),
            'disabilities' => app(DisabilityTypesRepository::class)
                ->disablePagination()
                ->all(),
            //'sectors' => app(SectorsRepository::class)
            //  ->disablePagination()
            //->all(),
            //'users' => app(UsersRepository::class)
            //  ->disablePagination()
            //->all(),
            'mode' => 'show' . (request()->query('disabled') ? '-read-only' : ''),
        ]);
    }*/

    public function update(PersonUpdate $request, $id)
    {
        app(PeopleRepository::class)->update($id, $request->all());

        PersonModel::sync($this)->disabilities(
            Disability::whereIn('id', $request['disabilities'])->get()
        );

        /*foreach ($request['disabilities'] as $disability) {
            echo $disability;
        }
        dd('ok');*/
        PersonModel::find($id)
            ->disabilities()
            ->sync($request['disabilities']);

        return redirect()
            ->route($request['redirect'])
            ->with('message', 'Pessoa alterada com sucesso!');
    }
}
