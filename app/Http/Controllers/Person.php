<?php

namespace App\Http\Controllers;

use App\Data\Repositories\People as PeopleRepository;
use App\Http\Requests\PersonUpdate;

class Person extends Controller
{
    public function update(PersonUpdate $request, $id)
    {
        $person = app(PeopleRepository::class)->update($id, $request->all());

        $person->disabilities()->sync($request['disabilities']);

        return redirect()
            ->route($request['redirect'])
            ->with('message', 'Pessoa alterada com sucesso!');
    }
}
