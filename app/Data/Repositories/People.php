<?php

namespace App\Data\Repositories;

use App\Models\Person;

class People extends Repository
{
    /**
     * @var string
     */
    protected $model = Person::class;

    public function createOrUpdateFromRequest(array $array)
    {
        unset($array['id']);

        return empty($array['person_id'])
            ? $this->create($array)
            : $this->update($array['person_id'], $array);
    }




}
