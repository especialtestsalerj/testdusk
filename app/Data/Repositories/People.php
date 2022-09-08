<?php

namespace App\Data\Repositories;

use App\Models\Person;

class People extends Repository
{
    /**
     * @var string
     */
    protected $model = Person::class;
}
