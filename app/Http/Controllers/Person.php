<?php

namespace App\Http\Controllers;

use App\Data\Repositories\People as PeopleRepository;
use App\Http\Requests\PersonCreate;
use App\Http\Requests\PersonUpdate;
use App\Http\Requests\Request;
use App\Models\Document;

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

    public function create(PersonCreate $request)
    {
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

        return redirect()
            ->route($request['redirect'])
            ->with('message', 'Pessoa adicionada com sucesso!');
    }
}
