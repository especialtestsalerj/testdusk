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
    public function update(PersonUpdate $request, $id)
    {
        $person =  app(PeopleRepository::class)->update($id, $request->all());
        $person->disabilities()->sync($request['disabilities']);

        return redirect()
            ->route($request['redirect'])
            ->with('message', 'Pessoa alterada com sucesso!');
    }
}
