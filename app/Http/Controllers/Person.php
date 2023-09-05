<?php

namespace App\Http\Controllers;

use App\Data\Repositories\People as PeopleRepository;
use App\Http\Requests\PersonUpdate;

class Person extends Controller
{
    public function update(PersonUpdate $request, $id)
    {
        $values = $request->all();

        if ($values['country_id'] == config('app.country_br')) {
            $values = array_merge($values, ['other_city' => null]);
        } else {
            $values = array_merge($values, ['state_id' => null]);
            $values = array_merge($values, ['city_id' => null]);
        }

        $person = app(PeopleRepository::class)->update($id, $values);

        $person->disabilities()->sync($request['disabilities']);

        return redirect()
            ->route($request['redirect'])
            ->with('message', 'Pessoa alterada com sucesso!');
    }
}
