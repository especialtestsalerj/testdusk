<?php

namespace App\Data\Repositories;

use App\Models\Country;

class Countries extends Repository
{
    /**
     * @var string
     */
    protected $model = Country::class;

    public function __get($key)
    {
        if (is_string($this->getAttribute($key))) {
            return convert_case($this->getAttribute($key), MB_CASE_UPPER);
        } else {
            return $this->getAttribute($key);
        }
    }

    public function allActive($id = null)
    {
        return $this->model
            ::where(function ($query) use ($id) {
                $query
                    ->when(isset($id), function ($query) use ($id) {
                        $query->orWhere('id', '=', $id);
                    })
                    ->orWhere('status', true);
            })
            ->orderBy('name')
            ->get();
    }
}
